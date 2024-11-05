import 'package:flutter/material.dart';

class HealthTipsScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'Health Tips',
              style: TextStyle(color: Colors.black, fontSize: 24),
            ),
            SizedBox(height: 20),
            Text(
              'Tip 1: Drink plenty of water',
              style: TextStyle(color: Colors.black, fontSize: 20),
            ),
            SizedBox(height: 20),
            Text(
              'Tip 2: Exercise regularly',
              style: TextStyle(color: Colors.black, fontSize: 20),
            ),
            // Add more health tips
          ],
        ),
      ),
    );
  }
}
