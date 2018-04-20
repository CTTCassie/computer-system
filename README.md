# computer-system
计算机学院信息化管理系统
1、学生和教师的登陆和注册功能
1>、登陆功能的几种情况：
a.用户输入正确的账号和密码即可成功登陆；
b.用户账号和密码均为空，提示请输入用户名和密码并再次进入到登陆页面；
c.用户输入的密码和数据表userinfo中已经注册的密码不一致，提示密码不正确并再次进入到登陆页面；
d.输入不存在的账户，提示用户不存在并再次进入到登陆页面；
2>、注册功能的几种情况
a.账户、密码、确认密码只要有一个为空，提示用户输入用户名密码和确认密码并再次进入到注册页面重新注册；
b.输入的用户名已经在数据表userinfo中存在，则提示用户已存在并再次进入注册页面重新注册；
c.用户输入的账号尚未注册且密码和确认密码一致，则提示注册成功，请登录字样，进入登录页面登录；
d.用户输入的账号尚未注册，但密码和确认密码不一致，则提示请确认密码一致，并重新注册；
3>、用户信息表userinfo中的密码password进行加密
a.用户注册成功，将注册时输入的密码进行base64_encode()加密和用户账户一起存入数据表userinfo中；
b.登陆时需要先将用户输入的密码和经过base64_decode()解密之后的密码进行判断，如果一致才成功登陆；
2、教师的各种获奖信息管理功能
1>、增加教师获奖信息功能
2>、保存输入的获奖信息功能
3>、单击可修改获奖信息功能
4>、删除已选中获奖信息功能
5>、取消编辑功能
6>、记录查询功能
可根据用户输入的姓名、科研获奖类别、科研获奖时间、教学获奖类别、教学获奖时间、其他获奖类别、其他获奖时间、显著业绩类别、显著业绩时间进行记录查询，并将找到的记录信息进行分页显示。
7>、分页显示获奖信息功能
设置每页可显示的数据总数Page_size，在数据表teacherinfo中统计要显示的所有数据个数count，此时(count/Page_size)并向上取整可计算得到总页数，同时也要计算偏移量offset；利用MySQL语句中的limit子句来控制每页要显示的数据。
8>、返回上一页功能
window.history.back();
9>、数据导出功能
  设置按钮触发事件，当点击该按钮时可下载当前页面显示在table中的所有记录；
