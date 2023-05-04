<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "title"
      },
      {
        "type": "text",
        "name": "content"
      },
      {
        "type": "number",
        "name": "id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "",
      "module": "core",
      "action": "condition",
      "options": {
        "if": "{{$_POST.id}}",
        "then": {
          "steps": {
            "name": "update",
            "module": "dbupdater",
            "action": "update",
            "options": {
              "connection": "dados",
              "sql": {
                "type": "update",
                "values": [
                  {
                    "table": "posts",
                    "column": "title",
                    "type": "text",
                    "value": "{{$_POST.title}}"
                  },
                  {
                    "table": "posts",
                    "column": "content",
                    "type": "text",
                    "value": "{{$_POST.content}}"
                  }
                ],
                "table": "posts",
                "wheres": {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_POST.id}}",
                      "data": {
                        "column": "id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "returning": "id",
                "query": "update `posts` set `title` = ?, `content` = ? where `id` = ?",
                "params": [
                  {
                    "name": ":P1",
                    "type": "expression",
                    "value": "{{$_POST.title}}",
                    "test": ""
                  },
                  {
                    "name": ":P2",
                    "type": "expression",
                    "value": "{{$_POST.content}}",
                    "test": ""
                  },
                  {
                    "operator": "equal",
                    "type": "expression",
                    "name": ":P3",
                    "value": "{{$_POST.id}}",
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
        },
        "else": {
          "steps": {
            "name": "insert",
            "module": "dbupdater",
            "action": "insert",
            "options": {
              "connection": "dados",
              "sql": {
                "type": "insert",
                "values": [
                  {
                    "table": "posts",
                    "column": "title",
                    "type": "text",
                    "value": "{{$_POST.title}}"
                  },
                  {
                    "table": "posts",
                    "column": "content",
                    "type": "text",
                    "value": "{{$_POST.content}}"
                  }
                ],
                "table": "posts",
                "returning": "id",
                "query": "insert into `posts` (`content`, `title`) values (?, ?)",
                "params": [
                  {
                    "name": ":P1",
                    "type": "expression",
                    "value": "{{$_POST.title}}",
                    "test": ""
                  },
                  {
                    "name": ":P2",
                    "type": "expression",
                    "value": "{{$_POST.content}}",
                    "test": ""
                  }
                ]
              }
            },
            "meta": [
              {
                "name": "identity",
                "type": "text"
              },
              {
                "name": "affected",
                "type": "number"
              }
            ]
          }
        }
      },
      "outputType": "boolean"
    }
  }
}
JSON
);
?>