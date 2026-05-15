<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopsTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genreImages = [
            1 => 'sushi.jpg',
            2 => 'yakiniku.jpg',
            3 => 'izakaya.jpg',
            4 => 'italian.jpg',
            5 => 'ramen.jpg',
        ];

        $params = [
            [
                'title' => '仙人',
                'area_id' => '1',
                'genre_id' => '1',
                'manager_id' => '1',
                'information' => '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。'
            ],
            [
                'title' => '牛助',
                'area_id' => '2',
                'genre_id' => '2',
                'manager_id' => '2',
                'information' => '焼肉業界で20年間経験を積み、肉を熟知したマスターによる実力派焼肉店。長年の実績とお付き合いをもとに、なかなか食べられない希少部位も仕入れております。また、ゆったりとくつろげる空間はお仕事終わりの一杯や女子会にぴったりです。',
            ],
            [
                'title' => '戰慄',
                'area_id' => '3',
                'genre_id' => '3',
                'manager_id' => '3',
                'information' => '気軽に立ち寄れる昔懐かしの大衆居酒屋です。キンキンに冷えたビールを、なんと199円で。鳥かわ煮込み串は販売総数100000本突破の名物料理です。仕事帰りに是非御来店ください。',

            ],
            [
                'title' => 'ルーク',
                'area_id' => '1',
                'genre_id' => '4',
                'manager_id' => '4',
                'information' => '都心にひっそりとたたずむ、古民家を改築した落ち着いた空間です。イタリアで修業を重ねたシェフによるモダンなイタリア料理とソムリエセレクトによる厳選ワインとのペアリングが好評です。ゆっくりと上質な時間をお楽しみください。',
            ],
            [
                'title' => '志摩屋',
                'area_id' => '3',
                'genre_id' => '5',
                'manager_id' => '5',
                'information' => 'ラーメン屋とは思えない店内にはカウンター席はもちろん、個室も用意してあります。ラーメンはこってり系・あっさり系ともに揃っています。その他豊富な一品料理やアルコールも用意しており、居酒屋としても利用できます。ぜひご来店をお待ちしております。',
            ],
            [
                'title' => '香',
                'area_id' => '1',
                'genre_id' => '2',
                'manager_id' => '6',
                'information' => '大小さまざまなお部屋をご用意してます。デートや接待、記念日や誕生日など特別な日にご利用ください。皆様のご来店をお待ちしております。',
            ],
            [
                'title' => 'JJ',
                'area_id' => '2',
                'genre_id' => '4',
                'manager_id' => '7',
                'information' => 'イタリア製ピザ窯芳ばしく焼き上げた極薄のミラノピッツァや厳選されたワインをお楽しみいただけます。女子会や男子会、記念日やお誕生日会にもオススメです。',
            ],
            [
                'title' => 'らーめん極み',
                'area_id' => '1',
                'genre_id' => '5',
                'manager_id' => '8',
                'information' => '一杯、一杯心を込めて職人が作っております。味付けは少し濃いめです。 食べやすく最後の一滴まで美味しく飲めると好評です。',
            ],
            [
                'title' => '鳥雨',
                'area_id' => '2',
                'genre_id' => '3',
                'manager_id' => '9',
                'information' => '素材の旨味を存分に引き出す為に、塩焼を中心としたお店です。比内地鶏を中心に、厳選素材を職人が備長炭で豪快に焼き上げます。清潔な内装に包まれた大人の隠れ家で贅沢で優雅な時間をお過ごし下さい。',
            ],
            [
                'title' => '築地色合',
                'area_id' => '1',
                'genre_id' => '1',
                'manager_id' => '10',
                'information' => '鮨好きの方の為の鮨屋として、迫力ある大きさの握りを1貫ずつ提供致します。',
            ],
            [
                'title' => '晴海',
                'area_id' => '2',
                'genre_id' => '2',
                'manager_id' => '11',
                'information' => '毎年チャンピオン牛を買い付け、仙台市長から表彰されるほどの上質な仕入れをする精肉店オーナーの本当に美味しい国産牛を食べてもらいたいという思いから誕生したお店です。',
            ],
            [
                'title' => '三子',
                'area_id' => '3',
                'genre_id' => '2',
                'manager_id' => '12',
                'information' => '最高級の美味しいお肉で日々の疲れを軽減していただければと贅沢にサーロインを盛り込んだ御膳をご用意しております。',
            ],
            [
                'title' => '八戒',
                'area_id' => '1',
                'genre_id' => '3',
                'manager_id' => '13',
                'information' => '当店自慢の鍋や焼き鳥などお好きなだけ堪能できる食べ放題プランをご用意しております。飲み放題は2時間と3時間がございます。',

            ],
            [
                'title' => '福助',
                'area_id' => '2',
                'genre_id' => '1',
                'manager_id' => '14',
                'information' => 'ミシュラン掲載店で磨いた、寿司職人の旨さへのこだわりはもちろん、 食事をゆっくりと楽しんでいただける空間作りも意識し続けております。 接待や大切なお食事にはぜひご利用ください。',
            ],
            [
                'title' => 'ラー北',
                'area_id' => '1',
                'genre_id' => '5',
                'manager_id' => '15',
                'information' => 'お昼にはランチを求められるサラリーマン、夕方から夜にかけては、学生や会社帰りのサラリーマン、小上がり席もありファミリー層にも大人気です。',
            ],
            [
                'title' => '翔',
                'area_id' => '2',
                'genre_id' => '3',
                'manager_id' => '16',
                'information' => '博多出身の店主自ら厳選した新鮮な旬の素材を使ったコース料理をご提供します。一人一人のお客様に目が届くようにしております。',
            ],
            [
                'title' => '経緯',
                'area_id' => '1',
                'genre_id' => '1',
                'manager_id' => '17',
                'information' => '職人が一つ一つ心を込めて丁寧に仕上げた、江戸前鮨ならではの味をお楽しみ頂けます。鮨に合った希少なお酒も数多くご用意しております。他にはない海鮮太巻き、当店自慢の蒸し鮑、是非ご賞味下さい。',
            ],
            [
                'title' => '漆',
                'area_id' => '1',
                'genre_id' => '2',
                'manager_id' => '18',
                'information' => '店内に一歩足を踏み入れると、肉の焼ける音と芳香が猛烈に食欲を掻き立ててくる。そんな漆で味わえるのは至極の焼き肉です。',
            ],
            [
                'title' => 'THE TOOL',
                'area_id' => '3',
                'genre_id' => '4',
                'manager_id' => '19',
                'information' => '非日常的な空間で日頃の疲れを癒し、ゆったりとした上質な時間を過ごせる大人の為のレストラン&バーです。',
            ],
            [
                'title' => '木船',
                'area_id' => '2',
                'genre_id' => '1',
                'manager_id' => '20',
                'information' => '毎日店主自ら市場等に出向き、厳選した魚介類が、お鮨をはじめとした繊細な料理に仕立てられます。また、選りすぐりの種類豊富なドリンクもご用意しております。',
            ],
        ];

        foreach($params as $param){
            $genreId = $param['genre_id'];

            if(!array_key_exists($genreId, $genreImages)){
                $this->command->warn("⚠️ ジャンルID{$genreId}が存在しないため、genre_idを1に変更します.");
                $genreId = 1;
            }

            $image = $genreImages[$genreId] ?? 'default.jpg';

            $path = 'public/shop-img/'. $image;
            if(!Storage::exists($path)){
                $this->command->warn("⚠️ 画像が存在しません:{$path}→default.jpgに置き換えます。");
                $image = 'default.jpg';
            }

            DB::table('shops')->insert([
                'title' => $param['title'],
                'area_id' => $param['area_id'],
                'genre_id' => $genreId,
                'manager_id' => $param['manager_id'],
                'information' => $param['information'],
                'image' => $image
            ]);
        }
    }
}
