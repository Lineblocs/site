<?php
namespace App\Helpers;
use App\ResourceArticle;
use DB;
final class PortalSearchHelper {
    public static function checkTitleMatches( $query, $title ) {
        return preg_match("/.*" . $query . ".*/", $title);
        //return TRUE;
    }

    public static function checkAnyTagMatches( $query, $tags ) {
        foreach ( $tags as $tag ) {
            $matches = preg_match("/.*" . $query . ".*/", $tag);
            if ( $matches ) {
                return TRUE;
            }
        }
        return FALSE;
    }



    public static function search( $query ) {
      $views = [
        [ 
            "title" => "Blocked Numbers", 
            "ui_identifier" => "settings-blocked-numbers", 
            "tags" => ['blocked', 'numbers']
        ],
        [ 
            "title" => "IP Whitelist", 
            "ui_identifier" => "settings-ip-whitelist", 
            "tags" => ['ip', 'whitelist']
        ],
        [ 
            "title" => "API Settings", 
            "ui_identifier" => "settings-workspace-api-settings",
            "tags" => ['api']
        ],
        [ 
            "title" => "Workspace Users", 
            "ui_identifier" => "settings-workspace-users", 
            "tags" => ['workspace', 'users'],
            'perms' => ['manage_users']
        ],
        [ 
            "title" => "Workspace Params", 
            "ui_identifier" => "settings-workspace-params", 
            "tags" => ['workspace', 'params']
        ],
        [  
            "title" => "Add Workspace User", 
            "ui_identifier" => "settings-workspace-users-create", 
            "tags" => ['add', 'workspace', 'user']
        ],
        [ 
            "title" => "Extension Codes", 
            "ui_identifier" => "settings-extension-codes", 
            "tags" => ['extension', 'codes']
        ],
        [ 
            "title" => "Media Files", 
            "ui_identifier" => "files", 
            "tags" => ['media', 'files', 'media files']
        ],
        [ 
            "title" => "Phones", 
            "ui_identifier" => "phones-phones", 
            "tags" => ['provision', 'phones'], 
            'perms' => ['manage_phones'],
        ],
        [ 
            "title" => "Add Phone", 
            "ui_identifier" => "phones-phone-create", 
            "tags" => ['add', 'phone'],
            'perms' => ['manage_phones'],
        ], 
        [ 
            "title" => "Phones Groups", 
            "ui_identifier" => "phones-groups", 
            "tags" => ['phones', 'groups'], 
            "perms" => ['manage_phonegroups']
        ],
        [ 
            "title" => "Add Phone Group", 
            "ui_identifier" => "phones-groups-create", 
            "tags" => ['add', 'group'], 
            "perms" => ['create_phonegroup']
        ],
        [ 
            "title" => "Phone Global Templates", 
            "ui_identifier" => "phones-global-settings", 
            "tags" => ['phones', 'global', 'templates'], 
            "perms" => ['manage_phoneglobalsettings'],
        ],
        [ 
            "title" => "Phone Individual Settings", 
            "ui_identifier" => "phones-individual-settings", 
            "tags" => ['phones', 'individual', 'settings'],
            "perms" => ['manage_phoneindividualsetting'],
        ],
        [ 
            "title" => "Deploy Phone Config", 
            "ui_identifier" => "phones-deploy-config", 
            "tags" => ['provision', 'phone', 'config', 'deploy'],
            "perms" => ['manage_phones'],
        ],
        [ 
            "title" => "My Numbers", 
            "ui_identifier" => "my-numbers", 
            "tags" => ['my', 'numbers'], 
            "perms" => ['manage_dids'],
        ],
        [ 
            "title" => "Buy Numbers", 
            "ui_identifier" => "buy-numbers", 
            "tags" => ['buy', 'numbers'], 
            "perms" => ['manage_dids'],
        ],
        [ 
            "title" => "Port-In Requests", 
            "ui_identifier" => "ports", 
            "tags" => ['port', 'requests', 'port in', 'dids'], 
            "perms" => ['manage_ports'],
        ],
        [ 
            "title" => "Create Port Request", 
            "ui_identifier" => "port-create", 
            "tags" => ['port', 'create', 'dids'], 
            "perms" => ['manage_ports'],
        ],
        [ 
            "title" => "Flows", 
            "ui_identifier" => "flows", 
            "tags" => ['flows', 'flow editor'], 
            "perms" => ['manage_flows'],
        ],
        [ 
            "title" => "Flow Editor", 
            "ui_identifier" => "flow-editor", 
            "tags" => ['flow editor'], 
            'state_params' => ["flowId"=>"new"],
            "perms" => ['create_flow'],
        ],
        [ 
            "title" => "Extensions", 
            "ui_identifier" => "extensions", 
            "tags" => ['extensions'],
            "perms" => ['manage_extensions'],
        ],
        [
            "title" => 'Add Extension',
            "ui_identifier" => "extension-create", 
            "tags" => ['add', 'extension'], 
            "perms" => ['create_extensions'],
        ],
        [ 
            "title" => "Logs", 
            "ui_identifier" => "debugger-logs", 
            "tags" => ['debugger logs', 'logs', 'debugger']
        ],
        [ 
            "title" => "Calls", 
            "ui_identifier" => "calls",
            "tags" => ['calls'], 
            "perms" => ['manage_calls'],
        ],
        [ 
            "title" => "Recordings", 
            "ui_identifier" => "recordings", 
            "tags" => ['recordings'], 
            "perms" => ['manage_recordings'],
        ],
        [ 
            "title" => "Faxes", 
            "ui_identifier" => "faxes", 
            "tags" => ['fax', 'faxes']
        ],
        [ 
            "title" => "Billing", 
            "ui_identifier" => "billing", 
            "tags" => ['billing', 'add card', 'cards', 'settings'],
            "perms" => ['manage_billing'],
        ],
        [ 
            "title" => "BYO Carriers", 
            "ui_identifier" => "byo-carriers",
            "tags" => ['byo', 'carriers'], 
            "perms" => ['manage_byo_carriers'], 
            'state_params' => ['bring_carrier']
        ],
        [ 
            "title" => "BYO DID Numbers", 
            "ui_identifier" => "byo-did-numbers", 
            "tags" => ['byo', 'did numbers', 'did', 'numbers'], 
            "perms" => ['manage_byo_did_numbers'], 
            'state_params' => 'bring_carrier'
        ]
        ];
        $result = [
          'categories' => [] 
        ];
        $portal_views = [
              'key' => 'portal_views',
              'results' => []
        ];
        $resource_articles = [
              'key' => 'resource_articles',
              'results' => []
        ];
        foreach ( $views as $view ) {
          // find match
          $title = $view['title'];
          $tags = $view['tags'];
          if ( self::checkTitleMatches( $query, $title ) ) {
            $portal_views['results'][] = $view;
            continue;
          }
          if ( self::checkAnyTagMatches( $query, $tags ) ) {
            $portal_views['results'][] = $view;
            continue;
          }
        }
        // find resource articles
        $resources= ResourceArticle::select(array('resource_articles.*', DB::raw('resource_sections.key_name AS section_key_name')));
        $resources->join('resource_sections', 'resource_sections.id', '=', 'resource_articles.section_id');
        $resources = $resources->where("resource_articles.name", 'like', '%'.$query.'%');
        foreach ($resources->get() as $item) {
            $article_key = $item['key_name'];
            $section_key = $item['section_key_name'];
            $url = MainHelper::createResourceArticleUrl($article_key, $section_key);
            $tags = explode(",", $item['seo_tags']);
            $resource_result = [
                'title' => $item['name'],
                'url' => $url,
                'tags' => $tags
            ];
            $resource_articles['results'][] = $resource_result;
        }
        $result['categories'][] = $portal_views;
        $result['categories'][] = $resource_articles;
        return $result;

    }

}
