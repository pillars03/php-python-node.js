var http = require('https');			// http 网路
var cheerio = require('cheerio');	// html 解析
var fs = require("fs");				// 流
var queryHref = "https://www.zhihu.com/question/30941719"; 	// 设置被查询的目标网址
var urls = [];


var pageData = "";
function getPic(href, serach) {
    var req = http.get(queryHref, function (res) {
        res.setEncoding('utf8');
        res.on('data', function (chunk) {
            // console.log(chunk);
            pageData += chunk;
        });

        res.on('end', function () {
            $ = cheerio.load(pageData);
            var html = $(".lazy");

            for (var i = 0; i < html.length; i++) {
                var src = html[i].attribs['data-actualsrc'];
                urls.push(src)
            }
            downImg(urls.shift());
        });
    });
}

function downImg(imgurl) {
    // 做一步优化，如果存在文件，则不下载
    var index = imgurl.lastIndexOf("\/");
    var filename = "./upload/topic1/" + imgurl.substring(index + 1, imgurl.length);
    fs.exists(filename, function (b) {
        if (!b) {
            // 文件不存则进行 下载
            http.get(imgurl, function (res) {
                var imgData = "";
                //一定要设置response的编码为binary否则会下载下来的图片打不开
                res.setEncoding("binary");

                res.on("data", function (chunk) {
                    imgData += chunk;
                });

                res.on("end", function () {
                    var savePath = filename;
                    console.log(savePath);
                    fs.writeFile(savePath, imgData, "binary", function (err) {
                        if (err) {
                            console.log(err);
                        } else {
                            console.log(imgurl);
                            if (urls.length > 0) {
                                downImg(urls.shift());
                            }
                        }
                    });
                });
            });
        } else {
            if (urls.length > 0) {
                downImg(urls.shift());
            }
        }
    });
    if (urls.length <= 0) {
        console.log("下载完毕");
    }
}

getPic();