#### 1 用户注册
#### 接口调用说明

	请求方式：GET
	请求url：/register
	
#### 请求参数说明

参数名   |   必填   |   类型   |  示例值    | 描述
-------- | -------- | -------- | ---------- | ---------
name  |   是     |   string    |   小明   | 用户姓名
email  |   是     |   string    |       | 经度
password  |   是     |   string    |       | 密码
password_confirmation  |   是     |   string    |       | 确认密码

#### 返回示例
```
{
  "id": 1
  "name": "ark",
  "email": "ark@qq.com",
  "updated_at": "2017-11-09 12:42:19",
  "created_at": "2017-11-09 12:42:19",
}
```
#### 2 用户登录
#### 接口调用说明

	请求方式：POST
	请求url：/login
	
#### 请求参数说明
参数名   |   必填   |   类型   |  示例值    | 描述
-------- | -------- | -------- | ---------- | ---------
email  |   是     |   string    |       | 用户名
password  |   是     |   string    |       | 密码

#### 返回示例
```
{
  "id": 1,
  "email": "ark@qq.com",
  "name": "ark",
  "created_at": "2017-11-04 04:08:29",
  "updated_at": "2017-11-04 04:08:29"
}
```
#### 3 用户登出
#### 接口调用说明

	请求方式：POST
	请求url：/logout
	
#### 请求参数说明
无

#### 4 新建终端
#### 接口调用说明

	请求方式：POST
	请求url：/terminals
	
#### 请求参数说明
无
#### 返回示例
```
{
    "pid": 24176
}
```
#### 5 保存代码
#### 接口调用说明

	请求方式：POST
	请求url：/codes
	
#### 请求参数说明

参数名   |   必填   |   类型   |  示例值    | 描述
-------- | -------- | -------- | ---------- | ---------
language  |   是     |   string    |  C语言    | 语言，可用值为“C语言”、“C++”、“Python2.7'”、“Python3”、“Java”、“PHP”
code  |   是     |   string    |       | 代码
filename  |   是     |   string    |   hello.c    | 保存代码的文件名
#### 返回示例
```
{
  "id": 1
  "user_id": 1,
  "language": "c",
  "code": "#include <stdio.h>\n int main()\n {\n    printf(\"hello world\\n\");\n    return 0;\n }",
  "filename": "HelloWorld.c",
  "updated_at": "2017-11-09 12:48:05",
  "created_at": "2017-11-09 12:48:05",
}
```

#### 6 运行代码
#### 接口调用说明

	请求方式：POST
	请求url：/run
	
#### 请求参数说明

参数名   |   必填   |   类型   |  示例值    | 描述
-------- | -------- | -------- | ---------- | ---------
language  |   是     |   string    |  C语言    | 语言，可用值为“C语言”、“C++”、“Python2.7'”、“Python3”、“Java”、“PHP”
code  |   是     |   string    |       | 代码


#### 7 用户代码列表
#### 接口调用说明

	请求方式：GET
	请求url：/codes
	
#### 请求参数说明
无
#### 返回示例
```
[
  {
    "id": 8,
    "user_id": 5,
    "filename": "HelloWorld.c",
    "language": "c",
    "code": "#include <stdio.h>\n int main()\n {\n    printf(\"hello world\\n\");\n    return 0;\n }",
    "created_at": "2017-11-09 12:48:05",
    "updated_at": "2017-11-09 12:48:05"
  },
  {
    "id": 7,
    "user_id": 5,
    "filename": "tt",
    "language": "c",
    "code": "",
    "created_at": "2017-11-09 12:46:50",
    "updated_at": "2017-11-09 12:46:50"
  }
]
```