import 'package:flutter/material.dart';
import 'medication_reminder_screen.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Medication Reminder App',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: MedicationReminderScreen(),
    );
  }
}
