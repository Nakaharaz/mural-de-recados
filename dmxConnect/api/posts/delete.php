<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "dados",
        "sql": {
          "type": "delete",
          "table": "posts",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "id",
                "field": "id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.id}}",
                "data": {
                  "column": "id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "id",
          "query": "delete from `posts` where `id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.id}}",
              "test": ""
            }
          ]
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>