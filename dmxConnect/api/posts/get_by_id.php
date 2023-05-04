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
      "name": "query",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "dados",
        "sql": {
          "type": "select",
          "columns": [],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.id}}",
              "test": ""
            }
          ],
          "table": {
            "name": "posts"
          },
          "primary": "id",
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "posts.id",
                "field": "posts.id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.id}}",
                "data": {
                  "table": "posts",
                  "column": "id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "id"
                  }
                },
                "operation": "=",
                "table": "posts"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "select * from `posts` where `posts`.`id` = ?"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "id"
        },
        {
          "type": "text",
          "name": "title"
        },
        {
          "type": "text",
          "name": "content"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>