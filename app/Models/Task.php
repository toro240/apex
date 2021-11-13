<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    const MAX_SUBJECT_LENGTH = 255;

    // TODO get Google Spread Sheet
    const MAP = [
        1 => 'WORLD\'S EDGE',
        2 => 'KINGS CANYON',
        3 => 'OLYMPUS',
        4 => 'STORM POINT',
    ];

    // TODO get Google Spread Sheet
    const LEGEND = [
        1 => 'ブラッドハウンド',
        2 => 'ジブラルタル',
        3 => 'ライフライン',
        4 => 'パスファインダー',
        5 => 'レイス',
        6 => 'バンガロール',
        7 => 'コースティック',
        8 => 'ミラージュ',
        9 => 'オクタン',
        10 => 'ワットソン',
        11 => 'クリプト',
        12 => 'レヴナント',
        13 => 'ローバ',
        14 => 'ランパート',
        15 => 'ホライゾン',
        16 => 'ヒューズ',
        17 => 'ヴァルキリー',
        18 => 'シア',
        19 => 'アッシュ',
    ];
}
