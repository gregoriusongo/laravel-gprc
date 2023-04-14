var PROTO_PATH = __dirname + '/../protos/auth.proto';
var grpc = require('@grpc/grpc-js');
var protoLoader = require('@grpc/proto-loader');
const sqlite3 = require('sqlite3').verbose();

var packageDefinition = protoLoader.loadSync(
   PROTO_PATH,
   {
      keepCase: true,
      longs: String,
      enums: String,
      defaults: true,
      oneofs: true
   });
var protoDescriptor = grpc.loadPackageDefinition(packageDefinition);

var authService = protoDescriptor.AuthService;

const db = new sqlite3.Database(':memory:');
// db migration
db.serialize(() => {
   db.run('CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, password TEXT)');
});

/**
 * Starts an RPC server
 */
function main() {
   var server = new grpc.Server();
   server.addService(authService.service, {
      LoginUser: login,
      RegisterUser: register,
   });
   server.bindAsync('0.0.0.0:50051', grpc.ServerCredentials.createInsecure(), () => {
      console.log("server started at 0.0.0.0:50051");
      server.start();
   });
}

/**
 * Register new user to database
 */
function register(call, callback) {
   const { username, password } = call.request;

   db.run('INSERT INTO users (username, password) VALUES (?, ?)', [username, password], (error) => {
      if (error) {
         callback({ message: error.message }, null);
      } else {
         callback(null, { success: true });
      }
   });
}

/**
 * Login function, get user from database
 */
function login(call, callback) {
   const { username, password } = call.request;

   db.get('SELECT * FROM users WHERE username = ?', [username], (error, row) => {
      if (error) {
         callback({ message: error.message }, null);
      } else if (!row || row.password !== password) {
         callback(null, { success: false, message: 'Incorrect username or password' });
      } else {
         callback(null, { success: true });
      }
   });
}

main();
