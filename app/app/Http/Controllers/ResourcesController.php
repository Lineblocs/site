<?php

namespace App\Http\Controllers;

use App\Article;
use App\PhotoAlbum;
use DB;
use Illuminate\Http\Request;
use Michelf\Markdown;
use Symfony\Component\Yaml\Yaml;
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

  }
  public function createACOptions() {
    $file = base_path("yaml/resources.yaml");
    $data = Yaml::parse(file_get_contents($file));
    $options = [];
    $links = [];
    $url = Config::get("app.url");

    foreach ($data['sections'] as $sectionArr) {
      foreach ($sectionArr['items'] as $item) {
        $name = $item['name'];
        $link = sprintf("%s/resources/%s/%s", $url, $sectionArr['link'], $item['link']);
          $options[$name] = null;
          $links[$name] = $link;
      }
    }
    return compact('options', 'links');
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
    $dataBefore = Yaml::parse(file_get_contents($file));
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

    if (!empty($search)) {
        $searched = TRUE;
        $lower1 = strtolower($search);
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
    $info = $this->getSection($section);
    $sectionName = $info['name'];
    $results = $info['results'];
    return view('resources.section', compact('section', 'sectionName', 'results'));
  }
  public function sectionItem(Request $request, $section, $item)
  {
    $markdown = file_get_contents( base_path("/docs/$section/$item.md") );
    $html = Markdown::defaultTransform($markdown); 
    $related = [];
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
    $title = $thisItem['name'];
    $tags = $thisItem['tags'];
    $description = $thisItem['description'];
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
