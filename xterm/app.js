// var cors = require('cors')
var express = require('express');
var app = express();
var os = require('os');
var pty = require('node-pty');

var terminals = {},
    logs = {};

// app.use(cors());
app.use('/build', express.static(__dirname + '/build'));

app.get('/', function(req, res){
    res.send('xterm server');
});

app.post('/terminals', function (req, res) {
  var cols = parseInt(req.query.cols),
      rows = parseInt(req.query.rows),
      term = pty.spawn(process.platform === 'win32' ? 'cmd.exe' : 'zsh', [], {
        name: 'xterm-color',
        cols: cols || 80,
        rows: rows || 24,
        cwd: process.env.PWD,
        env: process.env
      });
  console.log('Created terminal with PID: ' + term.pid);
  terminals[term.pid] = term;
  logs[term.pid] = '';
  term.on('data', function(data) {
    logs[term.pid] += data;
  });
  
  res.send(term.pid.toString());
  res.end();
});

var port = process.env.PORT || 3000,
    host = os.platform() === 'win32' ? '127.0.0.1' : '0.0.0.0';

console.log('App listening to http://' + host + ':' + port);
app.listen(port, host);
