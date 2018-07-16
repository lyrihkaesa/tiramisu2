<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Crysta;
use App\Forum;
use App\Gallery;
use App\Tag;
use App\BgMusic;

class SitemapController extends Controller
{
    public function index()
    {
      $barang = Barang::all();
      $crysta = Crysta::all();
      $forum = Forum::all();
      $img = Gallery::all();
      $tag = Tag::all();
      $bgm = BgMusic::all();

      return response()->view('sitemap.index',[
      	'equips' => $barang,
        'crystas' => $crysta,
        'forums' => $forum,
        'images'	=> $img,
        'tags' => $tag,
        'bgm' => $bgm
      ])->header('Content-Type', 'text/xml');
    }
}