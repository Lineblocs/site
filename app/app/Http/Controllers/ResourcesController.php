<?php

namespace App\Http\Controllers;

use App\Article;
use App\PhotoAlbum;
use DB;
use Illuminate\Http\Request;
use Michelf\Markdown;
use Symfony\Component\Yaml\Yaml;

use App\ResourceArticle;
use App\ResourceSection;
use View;
use Config;
class ResourcesController extends BaseController {

  private function getSection($section) {
    $file = base_path("yaml/resources.yaml");
    $data = Yaml::parse(file_get_contents($file));
    $results = [];
    foreach ($data['sections'] as $sectionArr) {
      if ($sectionArr['link']==$section) {
        $sectionName = $sectionArr['name'];
        foreach ($sectionArr['items'] as $item) {
           $results[] = ['section' => $sectionArr, 'item' => $item];
        }
        break;
      }
    }
    return ['name' => $sectionName, 'results' => $results];
    // new code
    //$sections =ResourceArticle::select(array('resource_articles.name', ))

  }

  private function getSection2($section) {
    $section = ResourceSection::where('key_name', $section)->firstOrFail();
    $results = $this->getResourceArticles( $section->id );
    return ['name' => $section['name'], 'results' => $results];
  }


  public function createACOptions() {
    $file = base_path("yaml/resources.yaml");
    $data = Yaml::parse(file_get_contents($file));
    $options = [];
    $links = [];
    $url = Config::get("app.url");

    /*
    foreach ($data['sections'] as $sectionArr) {
      foreach ($sectionArr['items'] as $item) {
        $name = $item['name'];
        $link = sprintf("%s/resources/%s/%s", $url, $sectionArr['link'], $item['link']);
          $options[$name] = null;
          $links[$name] = $link;
      }
    }
    */
    $articles = $this->getResourceArticles();
    foreach ( $articles as $item ) {
        $name = $item['name'];
        $link = sprintf("%s/resources/%s/%s", $url, $item['key_name'], $item['section_key_name']);
          $options[$name] = null;
          $links[$name] = $link;
    }
    return compact('options', 'links');
  }

  private function getResourceArticles($section_id=null) {
    $articles = ResourceArticle::select(array('resource_articles.*', DB::raw( 'resource_sections.key_name AS section_key_name')));
    $articles->join('resource_sections', 'resource_sections.id', '=', 'resource_articles.section_id');
    if ( !empty( $section_id )) {
      $articles->where('section_id', $section_id);
    }
    $articles = $articles->get();
    return $articles;
  }

  /**
   * Show the application dashboard to the user.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $search = $request->get("search");
    $file = base_path("yaml/resources.yaml");
    $resourceSections = ResourceSection::all();
    $dataBefore = Yaml::parse(file_get_contents($file));
    $articles = $this->getResourceArticles();
    $searched = FALSE;
    $results = [];
    $data = [
      'sections' => []
    ];
    foreach ($dataBefore['sections'] as $section) {
        $items = array_slice($section['items'], 0, 4);
        $new_entry = $section;
        $new_entry['items'] = $items;
        $data['sections'][] = $new_entry;
    }


    foreach ( $resourceSections as $item ) {
        $data['sections'][] = $item->toArray();
    }

    if (!empty($search)) {
        $searched = TRUE;
        $lower1 = strtolower($search);
        /*
        foreach ($dataBefore['sections'] as $section) {
          foreach ($section['items'] as $item) {
            $lower2 = strtolower($item['name']);
            $lower3 = strtolower($item['description']);
            $quoted = preg_quote($lower1);
            $match = preg_match("/" . $quoted . "/", $lower2, $matches);
            //if (strpos($lower2, $lower1) != FALSE) {
            if ($match) {
              $results[] = ['section' => $section, 'item' => $item];
              continue;
            }

            if (strpos($lower3, $lower1) != FALSE) {
              $results[] = ['section' => $section, 'item' => $item];
              continue;
            }
          }
        }
        */
        foreach ($articles as $item) {
          $lower2 = strtolower($item['name']);
          $lower3 = strtolower($item['description']);
          $quoted = preg_quote($lower1);
          $match = preg_match("/" . $quoted . "/", $lower2, $matches);
          //if (strpos($lower2, $lower1) != FALSE) {
          if ($match) {
            $results[] = $item;
            continue;
          }

          if (strpos($lower3, $lower1) != FALSE) {
            $results[] = $item;
            continue;
          }
        }

    }

    if ( $searched ) {
      $acOptions = $this->createACoptions();
      $query = $search;
      return view('resources.search_results', compact('data', 'searched', 'results', 'search', 'acOptions', 'query'));
    }
    $acOptions = $this->createACoptions();
    return view('resources.index', compact('data', 'searched', 'results', 'search', 'acOptions'));
  }
  public function section(Request $request, $section)
  {
    $file = base_path("yaml/resources.yaml");
    $data = Yaml::parse(file_get_contents($file));
    //$info = $this->getSection($section);
    $info = $this->getSection2($section);
    $sectionName = $info['name'];
    $results = $info['results'];
    return view('resources.section', compact('section', 'sectionName', 'results'));
  }
  public function sectionItem(Request $request, $section, $item)
  {
    $section =  ResourceSection::where('key_name', '=', $section)->firstOrFail();
    $article = ResourceArticle::where('key_name', '=', $item)->where('section_id', $section->id)->firstOrFail();

    //$markdown = file_get_contents( base_path("/docs/$section/$item.md") );
    $markdown = (string) $article->content;
    $html = Markdown::defaultTransform($markdown); 

    $related = [];
    /*
    $file = base_path("yaml/resources.yaml");
    $data = Yaml::parse(file_get_contents($file));
    $thisItem = null;
    $theSection = null;
    foreach ($data['sections'] as $sectionArr) {
      foreach ($sectionArr['items'] as $itemArr) {
        if ($itemArr['link'] == $item && $sectionArr['link'] == $section) {
          $theSection = $sectionArr;
          $thisItem = $itemArr;
          foreach ($sectionArr['items'] as $itemArr2) {
            if ($itemArr2['link']!==$item) {
              $related[] = ['section' => $sectionArr, 'item' => $itemArr2];
            }
          }
        }
      }
    }
    */
    $relatedArticles = $this->getResourceArticles( $section->id );
    foreach ( $relatedArticles as $item ) {
              $related[] = ['section' => $section->toArray(), 'item' => $item->toArray()];
    }
    $title = $article['name'];
    $tags = $article['seo_tags'];
    $description = $article['description'];
    View::share('title', $title);
    View::share('tags', $tags);
    View::share('description', $description);
    return view('resources.item', compact('html', 'related', 'title', 'section'));
  }
  public function sectionItem2(Request $request, $section, $item)
  {
    $section = ResourceSection::where('name',$section)->firstOrFail();
    $item= ResourceArticle::where('key_name',$item)->firstOrFail();
    $markdown = $item->content;
    $html = Markdown::defaultTransform($markdown); 
    $related = [];
    $related= ResourceArticle::where('section_id', $item->section_id)
        ->where('id', '!=', $item->id)
        ->orderBy('hits', 'DESC')
        ->get();

    $title = $item['name'];
    $tags = $item['seo_tags'];
    $description = $item['description'];
    $theSection = $section->toArray();
    View::share('title', $title);
    View::share('tags', $tags);
    View::share('description', $description);
    return view('resources.item', compact('html', 'related', 'title', 'theSection'));
  }
  public function backToBilling(Request $request)
  {
    return redirect("http://app.lineblocs.com/#/dashboard/billing?result=OK");
  }
  public function backToBillingCancel(Request $request)
  {
    return redirect("http://app.lineblocs.com/#/dashboard/billing?result=CANCEL");
  }



}
