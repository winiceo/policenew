define({ "api": [
  {
    "type": "get",
    "url": "/census/getone",
    "title": "获取单条记录",
    "description": "<p>@apiName GetoneCensus</p> ",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/getone"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census",
    "name": "GetCensusGetone"
  },
  {
    "type": "post",
    "url": "/census/change_status",
    "title": "更新状态",
    "description": "<p>@apiName statusCensus</p> ",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>记录状态 1为未审核,2为审核通过.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census",
    "name": "PostCensusChange_status"
  },
  {
    "type": "post",
    "url": "/census/delete",
    "title": "删除记录",
    "description": "<p>@apiName deleteCensus</p> ",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census",
    "name": "PostCensusDelete"
  },
  {
    "type": "post",
    "url": "/census/check_in",
    "title": "审核通过",
    "description": "<p>审核通过</p> ",
    "name": "check_in",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "reason",
            "description": "<p>操作理由.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/check_in"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census"
  },
  {
    "type": "post",
    "url": "/census/check_out",
    "title": "审核未通过",
    "description": "<p>审核未通过</p> ",
    "name": "check_out",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/check_out"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census"
  },
  {
    "type": "post",
    "url": "/census/create",
    "title": "创建户籍审核记录",
    "description": "<p>type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城</p> ",
    "name": "createCensus",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>状态，默认为1，待审核，2为已完成,</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>类型,type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "json",
            "description": "<p>,存储表格数据,提交json字符串</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "add_time",
            "description": "<p>创建日期.系统默认</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/create"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census"
  },
  {
    "type": "post",
    "url": "/census/search",
    "title": "查询户籍",
    "description": "<p>type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城</p> ",
    "name": "listCensus",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>按类型查询.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "star_time",
            "description": "<p>时间段：开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>时间段：结束日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>状态：1待审核,2为审核通过.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/search"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census"
  },
  {
    "type": "post",
    "url": "/census/mylist",
    "title": "我的审批表列表",
    "description": "<p>显示自己添加的审批列表</p> ",
    "name": "myList",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>按类型查询.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>状态：1待审核,2为审核通过.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/mylist"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census"
  },
  {
    "type": "get",
    "url": "/census/processing",
    "title": "获取需要处理的事项",
    "description": "<p>获取需要处理的事项</p> ",
    "name": "processing",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/processing"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census"
  },
  {
    "type": "post",
    "url": "/census/recreate",
    "title": "驳回的审请重新提交",
    "description": "<p>type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城</p> ",
    "name": "recreateCensus",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>状态，默认为1，待审核，2为已完成,</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>类型,type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "json",
            "description": "<p>,存储表格数据,提交json字符串</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "add_time",
            "description": "<p>创建日期.系统默认</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/recreate"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census"
  },
  {
    "type": "post",
    "url": "/census/update",
    "title": "更新户籍审核记录",
    "description": "<p>type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城</p> ",
    "name": "updateCensus",
    "group": "Census",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>状态，默认为1，待审核，2为已完成,</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>类型,type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "json",
            "description": "<p>,存储表格数据,提交json字符串</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "add_time",
            "description": "<p>创建日期.系统默认</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/census/update"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/census.php",
    "groupTitle": "Census"
  },
  {
    "type": "post",
    "url": "/check/create",
    "title": "添加考核",
    "description": "<p>添加考核内容</p> ",
    "name": "createCheck",
    "group": "Check",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "year",
            "description": "<p>考核年份.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "quarter",
            "description": "<p>考核季度.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "level",
            "description": "<p>考核结果等级.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "score",
            "description": "<p>考核结果得分.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "data",
            "description": "<p>考核项得分明细.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>被考核用户id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "year_score",
            "description": "<p>年度总得分（第四季度有效）.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "year_level",
            "description": "<p>年度总级别（第四季度有效）.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/check/create"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/check.php",
    "groupTitle": "Check"
  },
  {
    "type": "post",
    "url": "/check/find_one",
    "title": "绩效考核获取",
    "description": "<p>绩效考核获取</p> ",
    "name": "findOne",
    "group": "Check",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "year",
            "description": "<p>年份</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "quarter",
            "description": "<p>季度</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/check/my"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/check.php",
    "groupTitle": "Check"
  },
  {
    "type": "get",
    "url": "/check/get_users",
    "title": "下拉菜单获取用户",
    "description": "<p>获取待考核的下属用户名单</p> ",
    "name": "getUsers",
    "group": "Check",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/check/get_users"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/check.php",
    "groupTitle": "Check"
  },
  {
    "type": "post",
    "url": "/check/search",
    "title": "查询考核列表",
    "description": "<p>查询考核列表</p> ",
    "name": "listCheck",
    "group": "Check",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "page",
            "description": "<p>分页 为空则为1</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "department_id",
            "description": "<p>部门id,若为null,则返回全部用户的记录.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "year",
            "description": "<p>查询年份.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "quarter",
            "description": "<p>查询季度  .</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "actor_id",
            "description": "<p>创建者id  .</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "action",
            "description": "<p>查询类型0为非公示，1未考核，2已考核，3已完成 5为公示 .</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>审核状态，1000：部门领导完成，2：1100(1110) 政治处考核完，3:1010（1110)纪委督查考核完成，5：1111考核公示</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/check/search"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/check.php",
    "groupTitle": "Check"
  },
  {
    "type": "post",
    "url": "/check/my",
    "title": "我的绩效考核",
    "description": "<p>查询我的考核列表</p> ",
    "name": "myCheck",
    "group": "Check",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "page",
            "description": "<p>分页 为空则为1</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/check/my"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/check.php",
    "groupTitle": "Check"
  },
  {
    "type": "post",
    "url": "/check/public",
    "title": "考核公示，批量操作",
    "description": "<p>考核公示</p> ",
    "name": "publicCheck",
    "group": "Check",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Array</p> ",
            "optional": false,
            "field": "ids",
            "description": "<p>id数组.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/check/public"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/check.php",
    "groupTitle": "Check"
  },
  {
    "type": "post",
    "url": "/check/update",
    "title": "更新考核内容",
    "description": "<p>更新考核内容</p> ",
    "name": "updateCheck",
    "group": "Check",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "year",
            "description": "<p>考核年份.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "quarter",
            "description": "<p>考核季度.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "level",
            "description": "<p>考核结果等级.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "score",
            "description": "<p>考核结果得分.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "data",
            "description": "<p>考核项得分明细.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>被考核用户id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "year_score",
            "description": "<p>年度总得分（第四季度有效）.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "year_level",
            "description": "<p>年度总级别（第四季度有效）.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "action",
            "description": "<p>动作['update','plus','reduce','finish']</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/check/update"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/check.php",
    "groupTitle": "Check"
  },
  {
    "type": "post",
    "url": "/department/create",
    "title": "添加部门",
    "description": "<p>添加部门</p> ",
    "name": "createDep",
    "group": "Department",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "name",
            "description": "<p>部门名称.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "children_name",
            "description": "<p>子部门名称，以英文逗号分隔.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/department/create"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/department.php",
    "groupTitle": "Department"
  },
  {
    "type": "post",
    "url": "/department/delete",
    "title": "删除部门",
    "description": "<p>删除部门</p> ",
    "name": "deleteDepartment",
    "group": "Department",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/department/delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/department.php",
    "groupTitle": "Department"
  },
  {
    "type": "post",
    "url": "/department/find",
    "title": "获取单个部门信息",
    "description": "<p>根据id获取单部门信息</p> ",
    "name": "findOneDepartment",
    "group": "Department",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/department/find"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/department.php",
    "groupTitle": "Department"
  },
  {
    "type": "post",
    "url": "/department/search",
    "title": "部门列表",
    "description": "<p>部门列表</p> ",
    "name": "listDepartment",
    "group": "Department",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/department/search"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/department.php",
    "groupTitle": "Department"
  },
  {
    "type": "post",
    "url": "/department/update",
    "title": "更新部门",
    "description": "<p>更新部门</p> ",
    "name": "updateDepartment",
    "group": "Department",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "name",
            "description": "<p>部门名称.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "children_name",
            "description": "<p>子部门名称，以英文逗号分隔.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/department/update"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/department.php",
    "groupTitle": "Department"
  },
  {
    "type": "post",
    "url": "/helper/check_in",
    "title": "审核通过",
    "description": "<p>审核通过</p> ",
    "name": "check_in",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "reason",
            "description": "<p>操作理由.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/check_in"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "post",
    "url": "/helper/check_out",
    "title": "审核未通过",
    "description": "<p>审核未通过</p> ",
    "name": "check_out",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/check_out"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "get",
    "url": "/helper/getjob",
    "title": "获取职位名称",
    "description": "<p>职位名称直接系统定义</p> ",
    "name": "getJobs",
    "group": "Helper",
    "sampleRequest": [
      {
        "url": "/v1/helper/getjob\n5(4)->3->2-6-》1"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "get",
    "url": "/helper/getlevel",
    "title": "获取职位名称",
    "description": "<p>职位名称直接系统定义</p> ",
    "name": "getLevel",
    "group": "Helper",
    "sampleRequest": [
      {
        "url": "/v1/helper/getlevel"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "get",
    "url": "/helper/getrole",
    "title": "获取角色名称",
    "description": "<p>获取角色</p> ",
    "name": "getRole",
    "group": "Helper",
    "sampleRequest": [
      {
        "url": "/v1/helper/getrole"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "get",
    "url": "/helper/message",
    "title": "获取消息列表",
    "description": "<p>type1为请假；2为出差,3为待考核</p> ",
    "name": "getmessage",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/message"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "get",
    "url": "/helper/setting",
    "title": "系统配置信息获取",
    "description": "<p>key: sign_in_time签到时间;sign_out_time签退时间</p> ",
    "name": "getsetting",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/setting"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "get",
    "url": "/helper/message_read",
    "title": "将未读消息设为已读",
    "name": "message_read",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/message_read"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "get",
    "url": "/helper/message_unread_count",
    "title": "获取未读消息总数",
    "description": "<p>type1为请假；2为出差</p> ",
    "name": "message_unread_count",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/message_unread_count"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "get",
    "url": "/helper/processing",
    "title": "获取需要处理的事项",
    "description": "<p>获取需要处理的事项</p> ",
    "name": "processing",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/processing"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "post",
    "url": "/helper/setting",
    "title": "系统配置信息更新",
    "description": "<p>key: sign_in_time签到时间;sign_out_time签退时间</p> ",
    "name": "setting",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "key",
            "description": "<p>配置项key.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "value",
            "description": "<p>配置项value.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/setting"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "post",
    "url": "/helper/upload",
    "title": "上传接口",
    "description": "<p>上传,返回的name值为图像的绝对地址</p> ",
    "name": "upload",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>类型 1为用户图像，2为考核细则，3为考核流程图，4为日志附件，5为其它.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "title",
            "description": "<p>上传表单的名称.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>file</p> ",
            "optional": false,
            "field": "file",
            "description": "<p>上传表单的名称.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/upload"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "post",
    "url": "/helper/upload",
    "title": "上传接口",
    "description": "<p>上传,返回的name值为图像的绝对地址</p> ",
    "name": "upload",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>类型 1为用户图像，2为考核细则，3为考核流程图，4为日志附件，5为其它.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "title",
            "description": "<p>上传表单的名称.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>file</p> ",
            "optional": false,
            "field": "file",
            "description": "<p>上传表单的名称.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/upload"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/t1.php",
    "groupTitle": "Helper"
  },
  {
    "type": "post",
    "url": "/helper/upload_delete",
    "title": "删除上传的内容",
    "description": "<p>删除上传的内容,只能删除本人上传的内容</p> ",
    "name": "uploadDelete",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "name",
            "description": "<p>文件路径.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/upload_delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "post",
    "url": "/helper/upload_list",
    "title": "上传列表",
    "description": "<p>根据type返回上传列表</p> ",
    "name": "uploadList",
    "group": "Helper",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>类型 1为用户图像，2为考核细则，3为考核流程图，4为日志附件，5为其它.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/helper/upload_list"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/helper.php",
    "groupTitle": "Helper"
  },
  {
    "type": "post",
    "url": "/leave/create",
    "title": "请假审请",
    "description": "<p>请假审请</p> ",
    "name": "createLeave",
    "group": "Leave",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "start_time",
            "description": "<p>开始时间.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>结束时间.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "reason",
            "description": "<p>请假原因.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/leave/create"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/leave.php",
    "groupTitle": "Leave"
  },
  {
    "type": "post",
    "url": "/leave/delete",
    "title": "删除请假",
    "description": "<p>删除请假</p> ",
    "name": "deleteLeave",
    "group": "Leave",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/leave/delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/leave.php",
    "groupTitle": "Leave"
  },
  {
    "type": "post",
    "url": "/leave/search",
    "title": "查询请假情况",
    "description": "<p>我的请假列表</p> ",
    "name": "listLeave",
    "group": "Leave",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "page",
            "description": "<p>分页 为空则为1</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>被查询者id,若为null,则返回全部用户的记录.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "star_time",
            "description": "<p>时间段：开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>时间段：结束日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>审核状态，1：待审核，2：审核完成，3：审核未通过.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/leave/search"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/leave.php",
    "groupTitle": "Leave"
  },
  {
    "type": "post",
    "url": "/leave/update",
    "title": "修改请假信息",
    "description": "<p>更新请假</p> ",
    "name": "updateLeave",
    "group": "Leave",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "start_time",
            "description": "<p>开始时间.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>结束时间.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "reason",
            "description": "<p>请假原因.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/leave/update"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/leave.php",
    "groupTitle": "Leave"
  },
  {
    "type": "post",
    "url": "/member/change_pwd",
    "title": "更新用户",
    "description": "<p>更新用户资料</p> ",
    "name": "changPwd",
    "group": "Member",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/member/change_pwd"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/member.php",
    "groupTitle": "Member"
  },
  {
    "type": "post",
    "url": "/member/change_password",
    "title": "更新自己密码",
    "description": "<p>更新用户自己的密码</p> ",
    "name": "changePassword",
    "group": "Member",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/member/change_password"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/member.php",
    "groupTitle": "Member"
  },
  {
    "type": "post",
    "url": "/member/create",
    "title": "添加用户",
    "description": "<p>添加用户</p> ",
    "name": "createMember",
    "group": "Member",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "username",
            "description": "<p>用户名.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "job",
            "description": "<p>职位.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "real_name",
            "description": "<p>真实姓名.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "avatar_path",
            "description": "<p>图像地址.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "sex",
            "description": "<p>性别 1男，2女</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "department_id",
            "description": "<p>部门id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "secondary_department_name",
            "description": "<p>二级部门名称.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/member/create"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/member.php",
    "groupTitle": "Member"
  },
  {
    "type": "post",
    "url": "/member/delete",
    "title": "删除用户",
    "description": "<p>管理员操作，删除用户</p> ",
    "name": "deleteMember",
    "group": "Member",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>用户id.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/member/delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/member.php",
    "groupTitle": "Member"
  },
  {
    "type": "post",
    "url": "/member/profile",
    "title": "根据Id获取用户的信息",
    "description": "<p>根据Id获取用户的信息</p> ",
    "name": "getProfile",
    "group": "Member",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>要获取的用户id，若为空则返回当前登录用户.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/member/profile"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/member.php",
    "groupTitle": "Member"
  },
  {
    "type": "post",
    "url": "/member/list",
    "title": "用户列表",
    "description": "<p>管理员操作，显示所有用户</p> ",
    "name": "memberList",
    "group": "Member",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\nerr_code: 0,\nerr_msg: \"\",\ndata: [\n{\nid: \"1\",\nusername: \"admin\",\nemail: \"admin@71an.com\",\ngroup: \"admin\"\n},\n{\nid: \"19\",\nusername: \"leven\",\nemail: \"611796279@qq.com\",\ngroup: null\n},\n{\nid: \"20\",\nusername: \"chenshi\",\nemail: \"chenshi@qq.com\",\ngroup: null\n}\n]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/member/list"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/member.php",
    "groupTitle": "Member"
  },
  {
    "type": "post",
    "url": "/member/update",
    "title": "更新用户",
    "description": "<p>更新用户资料</p> ",
    "name": "updateMember",
    "group": "Member",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>用户id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "username",
            "description": "<p>用户名.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "job",
            "description": "<p>职位.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "real_name",
            "description": "<p>真实姓名.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "avatar_path",
            "description": "<p>图像地址.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "sex",
            "description": "<p>性别 1男，2女</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "department_id",
            "description": "<p>部门id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "secondary_department_name",
            "description": "<p>二级部门名称.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/member/update"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/member.php",
    "groupTitle": "Member"
  },
  {
    "type": "post",
    "url": "/note/add_comment",
    "title": "日志评论",
    "description": "<p>日志评论</p> ",
    "name": "addComment",
    "group": "Note",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>工作日志id .</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "comment",
            "description": "<p>内容.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/note/add_comment"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/note.php",
    "groupTitle": "Note"
  },
  {
    "type": "post",
    "url": "/note/status",
    "title": "更新公示状态",
    "description": "<p>修改公示状态 public_flag  1,公示，0未公示 有权操作</p> ",
    "name": "changeStatus",
    "group": "Note",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>任务id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "public_flag",
            "description": "<p>状态，1，公示，0，未公示</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/note/status"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/note.php",
    "groupTitle": "Note"
  },
  {
    "type": "post",
    "url": "/note/create",
    "title": "添加个人日志",
    "description": "<p>添加个人日志</p> ",
    "name": "createDep",
    "group": "Note",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "add_time",
            "description": "<p>日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "content",
            "description": "<p>内容.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "attach",
            "description": "<p>附件.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "over_work",
            "description": "<p>加班说明.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/note/create"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/note.php",
    "groupTitle": "Note"
  },
  {
    "type": "post",
    "url": "/note/delete",
    "title": "删除个人日志",
    "description": "<p>删除个人日志</p> ",
    "name": "deleteNote",
    "group": "Note",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/note/delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/note.php",
    "groupTitle": "Note"
  },
  {
    "type": "post",
    "url": "/note/list",
    "title": "查看下属工作日志",
    "description": "<p>级别为3只能查看自己部门，级别小于3则可以查看所有，级别大于3只能查看自己</p> ",
    "name": "listNote",
    "group": "Note",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "star_time",
            "description": "<p>时间段：开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "department_id",
            "description": "<p>级别小于3，部门id有效.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>级虽&lt;=3,用户id有效，级别=3，只能查看此部门用户.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>时间段：结束日期.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/note/list"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/note.php",
    "groupTitle": "Note"
  },
  {
    "type": "post",
    "url": "/note/public_note",
    "title": "公示列表",
    "name": "publicNote",
    "group": "Note",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "star_time",
            "description": "<p>时间段：开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>时间段：结束日期.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/note/public_note;"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/note.php",
    "groupTitle": "Note"
  },
  {
    "type": "post",
    "url": "/note/search",
    "title": "个人日志列表",
    "description": "<p>个人日志列表</p> ",
    "name": "searchNote",
    "group": "Note",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "star_time",
            "description": "<p>时间段：开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>时间段：结束日期.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/note/search"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/note.php",
    "groupTitle": "Note"
  },
  {
    "type": "post",
    "url": "/note/update",
    "title": "更新个人日志",
    "description": "<p>更新个人日志</p> ",
    "name": "updateNote",
    "group": "Note",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "add_time",
            "description": "<p>日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "content",
            "description": "<p>内容.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "attach",
            "description": "<p>附件.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "over_work",
            "description": "<p>加班说明.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/note/update"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/note.php",
    "groupTitle": "Note"
  },
  {
    "type": "post",
    "url": "/power/get",
    "title": "获取当前用登录用户权限",
    "description": "<p>获取当前用登录用户权限</p> ",
    "name": "powerGet",
    "group": "Power",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/power/get"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/power.php",
    "groupTitle": "Power"
  },
  {
    "type": "post",
    "url": "/power/list",
    "title": "用户列表",
    "description": "<p>管理员操作，显示所有用户,权限1:创建审批;2:派出所意见审批;3;治安大队意见审批;4;局领导意见审批</p> ",
    "name": "powerList",
    "group": "Power",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/power/list"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/power.php",
    "groupTitle": "Power"
  },
  {
    "type": "post",
    "url": "/power/set",
    "title": "更新权限",
    "description": "<p>有记录则删除,无记录再添加</p> ",
    "name": "powerSet",
    "group": "Power",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id,</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "power_level",
            "description": "<p>权限值,逗号分隔,1:创建审批;2:派出所意见审批;3;治安大队意见审批;4;局领导意见审批</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/power/set"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/power.php",
    "groupTitle": "Power"
  },
  {
    "type": "post",
    "url": "/task/delete",
    "title": "删除任务",
    "description": "<p>@apiName deletetask</p> ",
    "group": "Task",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/task/delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/task.php",
    "groupTitle": "Task",
    "name": "PostTaskDelete"
  },
  {
    "type": "post",
    "url": "/task/add_instructions",
    "title": "领导添加批示",
    "description": "<p>领导添加批示</p> ",
    "name": "addInstructions",
    "group": "Task",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "instructions",
            "description": "<p>内容.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/task/add_instructions"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/task.php",
    "groupTitle": "Task"
  },
  {
    "type": "post",
    "url": "/task/status",
    "title": "更新自己任务状态",
    "description": "<p>修改自己的任务状态 public_flag  1,公示，0未公示 指挥中心用户，有权操作</p> ",
    "name": "changeStaus",
    "group": "Task",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>任务id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>状态，1，未完成，2为完成</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "remark",
            "description": "<p>备注.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/task/status"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/task.php",
    "groupTitle": "Task"
  },
  {
    "type": "post",
    "url": "/task/create",
    "title": "创建任务",
    "description": "<p>type为1部门任务，2为个人任务</p> ",
    "name": "createtask",
    "group": "Task",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "department_id",
            "description": "<p>部门id(type为1时需有部门Id).</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id(type为2时需要有用户id).</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>状态，默认为1，未完成，2为已完成,</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>类型.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "title",
            "description": "<p>标题.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "content",
            "description": "<p>内容.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "add_time",
            "description": "<p>创建日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "limit_time",
            "description": "<p>任务完成日期</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "attachs",
            "description": "<p>数组转josn字符串</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/task/create"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/task.php",
    "groupTitle": "Task"
  },
  {
    "type": "get",
    "url": "/task/get_users",
    "title": "下拉菜单获取用户",
    "description": "<p>获取待考核的下属用户名单</p> ",
    "name": "getUsers",
    "group": "Task",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/task/get_users"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/task.php",
    "groupTitle": "Task"
  },
  {
    "type": "post",
    "url": "/task/search",
    "title": "查询任务",
    "description": "<p>type为1为部门任务，2为个人任务</p> ",
    "name": "listTasks",
    "group": "Task",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>被查询者id,若为null,则返回全部用户的记录.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>返回指定的类型，为null返回全部类型.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "department_id",
            "description": "<p>部门id,为null返回全部部门.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "star_time",
            "description": "<p>时间段：开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>时间段：结束日期.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/task/search"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/task.php",
    "groupTitle": "Task"
  },
  {
    "type": "post",
    "url": "/task/my",
    "title": "我的任务",
    "name": "myTasks",
    "group": "Task",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>被查询者id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "actor_id",
            "description": "<p>发布者id .</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "star_time",
            "description": "<p>时间段：开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>时间段：结束日期.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/task/my"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/task.php",
    "groupTitle": "Task"
  },
  {
    "type": "post",
    "url": "/task/public_task",
    "title": "任务完成情况公示",
    "description": "<p>type为1为部门任务，2为个人任务</p> ",
    "name": "publicTasks",
    "group": "Task",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>被查询者id,若为null,则返回全部用户的记录.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>返回指定的类型，为null返回全部类型.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "department_id",
            "description": "<p>部门id,为null返回全部部门.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "star_time",
            "description": "<p>时间段：开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>时间段：结束日期.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/task/public_task"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/task.php",
    "groupTitle": "Task"
  },
  {
    "type": "post",
    "url": "/task/update",
    "title": "更新任务",
    "description": "<p>type为1部门任务，2为个人任务</p> ",
    "name": "updatetask",
    "group": "Task",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>任务id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "department_id",
            "description": "<p>部门id(type为1时需有部门Id).</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id(type为2时需要有用户id).</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>状态，默认为1，未完成，2为已完成.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>类型.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "title",
            "description": "<p>标题.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "content",
            "description": "<p>内容.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "add_time",
            "description": "<p>创建日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "limit_time",
            "description": "<p>任务完成日期</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "attachs",
            "description": "<p>数组转json字符串</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/task/update"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/task.php",
    "groupTitle": "Task"
  },
  {
    "type": "post",
    "url": "/travel/create",
    "title": "出差审请",
    "description": "<p>出差审请</p> ",
    "name": "createTravel",
    "group": "Travel__",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "start_time",
            "description": "<p>开始时间.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>结束时间.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "reason",
            "description": "<p>出差原因.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "address",
            "description": "<p>出差地点.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/travel/create"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/travel.php",
    "groupTitle": "Travel__"
  },
  {
    "type": "post",
    "url": "/travel/delete",
    "title": "删除出差",
    "description": "<p>删除出差</p> ",
    "name": "deleteTravel",
    "group": "Travel__",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/travel/delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/travel.php",
    "groupTitle": "Travel__"
  },
  {
    "type": "post",
    "url": "/travel/search",
    "title": "查询出差情况",
    "description": "<p>我的出差列表</p> ",
    "name": "listTravel",
    "group": "Travel__",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "page",
            "description": "<p>分页 为空则为1</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>被查询者id,若为null,则返回全部用户的记录.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "star_time",
            "description": "<p>时间段：开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>时间段：结束日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>审核状态，1：待审核，2：审核完成，3：审核未通过.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/travel/search"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/travel.php",
    "groupTitle": "Travel__"
  },
  {
    "type": "post",
    "url": "/travel/update",
    "title": "修改出差信息",
    "description": "<p>更新出差</p> ",
    "name": "updateTravel",
    "group": "Travel__",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>记录id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "start_time",
            "description": "<p>开始时间.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>结束时间.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "reason",
            "description": "<p>出差原因.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "address",
            "description": "<p>出差地点.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/travel/update"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/travel.php",
    "groupTitle": "Travel__"
  },
  {
    "type": "post",
    "url": "/user/login",
    "title": "用户登录",
    "name": "GetUser",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "username",
            "description": "<p>用户登录名.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "password",
            "description": "<p>用户密码.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n   {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"token\": {\n\"jwt\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA\"\n},\n\"user\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n{\n\"err_code\": 1,\n\"err_msg\": \"登录失败\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/user/login"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/user.php",
    "groupTitle": "User"
  },
  {
    "description": "<p>我的考勤统计</p> ",
    "permission": [
      {
        "name": "member",
        "title": "User access only",
        "description": "<p>登录后的用户可以操作.</p> "
      }
    ],
    "type": "post",
    "url": "/user/my_statistics",
    "title": "我的考勤统计",
    "name": "Statistics",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "start_time",
            "description": "<p>开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>结束日期.</p> "
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/user/my_statistics"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/user.php",
    "groupTitle": "User"
  },
  {
    "description": "<p>我的签到</p> ",
    "permission": [
      {
        "name": "member",
        "title": "User access only",
        "description": "<p>登录后的用户可以操作.</p> "
      }
    ],
    "type": "post",
    "url": "/user/my_sign",
    "title": "我的签到",
    "name": "mySign",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "start_time",
            "description": "<p>开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>结束日期.</p> "
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/user/my_sign"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/user.php",
    "groupTitle": "User"
  },
  {
    "description": "<p>每天每用户只能签到一次，签到过的不能再签到</p> ",
    "permission": [
      {
        "name": "member",
        "title": "User access only",
        "description": "<p>登录后的用户可以操作.</p> "
      }
    ],
    "type": "get",
    "url": "/user/sign_in",
    "title": "用户签到",
    "name": "sign",
    "group": "User",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/user/sign_in"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/user.php",
    "groupTitle": "User"
  },
  {
    "description": "<p>每天每用户只能签退一次，签到过的不能再签退</p> ",
    "permission": [
      {
        "name": "member",
        "title": "User access only",
        "description": "<p>登录后的用户可以操作.</p> "
      }
    ],
    "type": "get",
    "url": "/user/sign_out",
    "title": "用户签退",
    "name": "sign_out",
    "group": "User",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/user/sign_out"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/user.php",
    "groupTitle": "User"
  },
  {
    "description": "<p>光荣榜</p> ",
    "permission": [
      {
        "name": "member",
        "title": "User access only",
        "description": "<p>登录后的用户可以操作.</p> "
      }
    ],
    "type": "post",
    "url": "/user/honor_roll",
    "title": "光荣榜",
    "name": "userHonorRoll",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "year",
            "description": "<p>年份</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "quarter",
            "description": "<p>季度</p> "
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/user/honor_roll"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/user.php",
    "groupTitle": "User"
  },
  {
    "description": "<p>用户的考勤统计</p> ",
    "permission": [
      {
        "name": "member",
        "title": "User access only",
        "description": "<p>登录后的用户可以操作.</p> "
      }
    ],
    "type": "post",
    "url": "/user/user_statistics",
    "title": "用户的考勤统计",
    "name": "userStatistics",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "start_time",
            "description": "<p>开始日期.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Datetime</p> ",
            "optional": false,
            "field": "end_time",
            "description": "<p>结束日期.</p> "
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/user/user_statistics"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/user.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/user/info",
    "title": "获取用户信息",
    "name": "userinfo",
    "group": "User",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_code",
            "description": "<p>状态码0为成功.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "err_msg",
            "description": "<p>信息提示.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n\"err_code\": 0,\n\"err_msg\": \"success\",\n\"data\": {\n\"id\": \"1\",\n\"username\": \"admin\",\n\"email\": \"admin@71an.com\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The id of the User was not found.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/v1/user/info"
      }
    ],
    "version": "0.0.0",
    "filename": "app/route/user.php",
    "groupTitle": "User"
  }
] });