@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/checkin.css') }}">
@endsection

@section('content')
<div class="QrScan-wrapper">
    <h2 class="QrScan-ttl">QRコード読み取り</h2>
    <!-- スキャンエリア -->
    <div id="reader" style="width: 300px; margin: 0 auto;"></div>
    <a href="/manager" class="backBtn">管理画面に戻る</a>
    <!-- 結果表示 -->
    <div id="resultModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="result-box">
            <h3 class="result-ttl">チェックイン結果</h3>
            <p id="resultText" class="result-text"></p>
            <button class="close-btn" id="closeResultModal">
                閉じる
            </button>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        //QRスキャン部分
        const html5QrCode = new Html5Qrcode('reader');
        const config = {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        };
        //結果部分の定義(モーダル・テキスト・閉じるボタン)
        const resultModal = document.getElementById('resultModal');
        const resultText = document.getElementById('resultText');
        const closeBtn = document.getElementById('closeResultModal')
        //カメラ起動
        Html5Qrcode.getCameras()
            .then(cameras => {
                if (!cameras.length) {
                    resultText.textContent = "カメラが見つかりません";
                    resultModal.classList.add('active');
                    return;
                }

                const backCamera = cameras.find(camera =>
                    camera.label.toLowerCase().includes('back')
                );
                const cameraId = backCamera ? backCamera.id :cameras[0].id;
                html5QrCode.start(cameraId, config, onScanSuccess);
            })
            .catch(err => {
                resultText.textContent = "カメラ起動エラー";
                resultModal.classList.add('active');
                console.error(err);
            });

        //QR成功時
        function onScanSuccess(decodedText) {
            //連続スキャン防止
            html5QrCode.stop();
            // QR内部のJSONを取得
            let qrData;
            try {
                qrData = JSON.parse(decodedText);
            } catch (e) {
                resultText.textContent = "❌ 不正なQRコードです";
                resultModal.classList.add('active');
                return;
            }
            fetch("{{ route('store.QrScan') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(qrData)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        resultText.textContent = "❌ " + data.error;
                    } else {
                        resultText.textContent = "✅ " + data.message;
                    }
                    //モーダル表示
                    resultModal.classList.add('active');
                })
                .catch(err => {
                    resultText.textContent = "通信エラー";
                    resultModal.classList.add('active');
                    console.error(err);
                });
        }
        //閉じる
        closeBtn.addEventListener('click', () => {
            resultModal.classList.remove('active');
            //再スキャン開始
            location.reload();
        });
        //背景クリックで閉じる
        document.querySelector('.modal-overlay').
        addEventListener('click', () =>{
            resultModal.classList.remove('active');
            location.reload();
        });

    });
</script>
@endsection