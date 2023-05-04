<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "search"
      },
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "dados",
        "sql": {
          "type": "select",
          "columns": [],
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.search}}",
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
                "id": "posts.title",
                "field": "posts.title",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.search}}",
                "data": {
                  "table": "posts",
                  "column": "title",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "maxLength": 255,
                    "primary": false,
                    "nullable": true,
                    "name": "title"
                  }
                },
                "operation": "LIKE"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "posts",
              "column": "title",
              "direction": "ASC"
            }
          ],
          "query": "select * from `posts` where `posts`.`title` like ? order by `title` ASC"
        }
      },
      "output": true,
      "meta": [
        {
          "name": "offset",
          "type": "number"
        },
        {
          "name": "limit",
          "type": "number"
        },
        {
          "name": "total",
          "type": "number"
        },
        {
          "name": "page",
          "type": "object",
          "sub": [
            {
              "name": "offset",
              "type": "object",
              "sub": [
                {
                  "name": "first",
                  "type": "number"
                },
                {
                  "name": "prev",
                  "type": "number"
                },
                {
                  "name": "next",
                  "type": "number"
                },
                {
                  "name": "last",
                  "type": "number"
                }
              ]
            },
            {
              "name": "current",
              "type": "number"
            },
            {
              "name": "total",
              "type": "number"
            }
          ]
        },
        {
          "name": "data",
          "type": "array",
          "sub": [
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
          ]
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>