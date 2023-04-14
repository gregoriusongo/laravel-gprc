var PROTO_PATH = __dirname + '/../protos/auth.proto';
var grpc = require('@grpc/grpc-js');
var protoLoader = require('@grpc/proto-loader');
// Suggested options for similarity to existing grpc.load behavior
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
// The protoDescriptor object has the full package hierarchy
var authService = protoDescriptor.AuthService;

var auth = require('./auth');

/**
 * Starts an RPC server that receives requests for the Greeter service at the
 * sample server port
 */
function main() {
   var server = new grpc.Server();
   server.addService(authService.service, { LoginUser: login });
   server.bindAsync('0.0.0.0:50051', grpc.ServerCredentials.createInsecure(), () => {
      console.log("server started at 0.0.0.0:50051");
      server.start();
   });
}

function login(){
   console.log('OK');
}

main();
