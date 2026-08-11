<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>{{ $data['title'] }}</title>
</head>

<body style="margin:0;padding:0;background:#f5f5f5;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f5f5f5;padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background:#ffffff; border:1px solid #dddddd;border-radius:8px;">
                    <tr>
                        <td style="padding:40px;">
                            <!-- ロゴ・タイトル -->
                            <h1 style="margin:0; font-size:30px; font-weight:bold;color:#2b4eff; font-family:'Hiragino Sans','Yu Gothic',sans-serif;">
                                Rese
                            </h1>
                            <p style="margin:8px 0 35px; font-size:15px; color:#322929; font-family:'Hiragino Sans','Yu Gothic',sans-serif;">
                                飲食店予約サービス
                            </p>
                            <hr style="border:none; border-top:1px solid #e5e5e5; margin:0 0 35px;">
                            <!-- 本文 -->
                            <div style="font-size:16px; line-height:1.9; color:#322929; font-family:'Hiragino Sans','Yu Gothic',sans-serif; word-break:break-word;">
                                {!! nl2br(e($data['text'])) !!}
                            </div>
                            <hr style="border:none; border-top:1px solid #e5e5e5; margin:40px 0 25px;">
                            <!-- フッター -->
                            <p style="margin:0; font-size:14px; line-height:1.8; color:#322929;font-family:'Hiragino Sans','Yu Gothic',sans-serif;">
                                このメールは <strong>Rese</strong> より送信されています。<br>
                                本メールは送信専用です。返信されてもお答えできませんのでご了承ください。<br><br>
                                Rese 運営事務局
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>