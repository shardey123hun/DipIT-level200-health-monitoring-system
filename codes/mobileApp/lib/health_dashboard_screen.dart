import 'package:flutter/material.dart';
import 'package:flutter_inappwebview/flutter_inappwebview.dart';

class WebViewScreen extends StatefulWidget {
  @override
  _WebViewScreenState createState() => _WebViewScreenState();
}

class _WebViewScreenState extends State<WebViewScreen> {
  late InAppWebViewController _controller;
 
  @override
  void initState() {
    super.initState();
    // Enable hybrid composition.
  
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: ()async{
        if(await _controller.canGoBack()){
          _controller.goBack();
          return false;
        }else{
          return true;
        }
      },
      child:  Scaffold(
      appBar: AppBar(

      ),
      body: Stack(
        children: [
           InAppWebView(
              initialUrlRequest: URLRequest(
                url: Uri.parse('http://192.168.134.51/heathtracker/'),
              ),
                onWebViewCreated: (InAppWebViewController webViewController) {
                _controller = webViewController;
          },
              // onPageStarted: (String url) {
              //   setState(() {
              //     _isLoading = true;
              //   });
              // },
              // onPageFinished: (String url) {
              //   setState(() {
              //     _isLoading = false;
              //   });
              // },
           
            ),]
          ),
         
      )
    );
  
  }
}
