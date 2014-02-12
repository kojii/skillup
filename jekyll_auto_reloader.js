var exec = require('child_process').exec;
var fs = require('fs');

var jekyll = exec('jekyll server');

fs.watch('1', reload);
fs.watch('2', reload);
fs.watch('3', reload);
fs.watch('_layouts', reload);

function reload(event, fileName){
	var now = new Date();
	var time = [now.getHours(), now.getMinutes(), now.getSeconds()].map(function(a){
		return a < 10 ? '0' + a : a;
	}).join(':');
	console.log(time, event, fileName);
	jekyll.kill();
	jekyll = exec('jekyll server');
}