import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'db/db_helper.dart';
import 'models/reminder.dart';
import 'health_dashboard_screen.dart';

class MedicationReminderScreen extends StatefulWidget {
  @override
  _MedicationReminderScreenState createState() => _MedicationReminderScreenState();
}

class _MedicationReminderScreenState extends State<MedicationReminderScreen> {
  late FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin;
  List<Reminder> reminders = [];
  final DBHelper dbHelper = DBHelper();

  @override
  void initState() {
    super.initState();
    flutterLocalNotificationsPlugin = FlutterLocalNotificationsPlugin();
    const androidInitializationSettings = AndroidInitializationSettings('@mipmap/ic_launcher');
    const darwinInitializationSettings = DarwinInitializationSettings();
    const initializationSettings = InitializationSettings(
      android: androidInitializationSettings,
      iOS: darwinInitializationSettings,
    );
    flutterLocalNotificationsPlugin.initialize(initializationSettings);
    _loadReminders();
  }

  Future<void> _loadReminders() async {
    reminders = await dbHelper.getReminders();
    setState(() {});
  }

  Future<void> _scheduleNotification(Reminder reminder) async {
    try {
      var androidDetails = const AndroidNotificationDetails(
        'channelId',
        'channelName',
        channelDescription: 'channelDescription',
        importance: Importance.high,
        priority: Priority.high,
      );
      var iosDetails = const DarwinNotificationDetails();
      var platformDetails = NotificationDetails(android: androidDetails, iOS: iosDetails);

      var scheduledTime = Time(reminder.hour, reminder.minute, 0);

      await flutterLocalNotificationsPlugin.showDailyAtTime(
        reminder.id!,
        reminder.title,
        'It\'s time to take your medicine',
        scheduledTime,
        platformDetails,
      );
    } catch (e) {
      print('Error scheduling notification: $e');
    }
  }

  Future<void> _addReminder(Reminder reminder) async {
    int id = await dbHelper.insertReminder(reminder);
    reminder = Reminder(
      id: id,
      title: reminder.title,
      hour: reminder.hour,
      minute: reminder.minute,
    );
    await _scheduleNotification(reminder);
    setState(() {
      reminders.add(reminder);
    });
  }

  Future<void> _deleteReminder(int id) async {
    await dbHelper.deleteReminder(id);
    await flutterLocalNotificationsPlugin.cancel(id);
    _loadReminders();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
         appBar: AppBar(
          automaticallyImplyLeading: false,
          backgroundColor: Colors.blue,
          title: const Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children:[
              Text("Health monitoring system",
               style: TextStyle(
                  color: Colors.white
                )
              ), 
              ] ),
              actions:[
                Builder(builder: (context){
              return IconButton(icon: Icon (Icons.menu,
              color: Colors.white,
              size: 30,),
              onPressed:(){
                Scaffold.of(context).openDrawer();
              });
              })
                ]
        ),
      body: Container(
        color: Color.fromRGBO(241, 237, 249, 1),
        padding: const EdgeInsets.all(10.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,          
          children: [
            const SizedBox(height: 20),
            ElevatedButton(
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => WebViewScreen()),
                );
              },
              child: const Text('GO TO DASHBOARD'),
            ),
            Expanded(
              child:Column(children: [
             Container(
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                         Container(
                          width: 325,
                          height: 240,
                          margin:EdgeInsets.only(right: 15),
                          child: Image.asset('assets/t4.jfif'),
                        ),
                        //  Container(
                        //   width: 145,
                        //   height: 150,
                        //   margin:EdgeInsets.only(right: 15),
                        //   child: Image.asset('assets/t1.jfif'),
                        // ),                        
                      ],
                    ),
                  ),
            // const SizedBox(height: 20),
            Container(
              color: Colors.white,
              padding: EdgeInsets.all(10),
              child: Row(children: [
              Text('Timed medicines', style: TextStyle(fontSize: 25, fontWeight: FontWeight.w500),),

              ],)
              
            ),
            Expanded(   
              child: ListView.builder(
                itemCount: reminders.length,
                itemBuilder: (context, index) {
                  final reminder = reminders[index];
                  return Card(
                    color: Colors.white,
                    margin: EdgeInsets.all(5),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(15.0), // Set rounded corners
                    ),
                    child: ListTile(
                      title: Text(reminder.title),
                      subtitle: Text('${reminder.hour}:${reminder.minute}',
                      style: TextStyle(color: Colors.blue),
                      ),
                      trailing: IconButton(
                        color: Colors.red,
                        icon: Icon(Icons.delete),
                        onPressed: () => _deleteReminder(reminder.id!),
                      ),
                    ),
                  );
                },
              ),
            ),
          ],
        ),
        ),
        ],)
      ),
       floatingActionButton: FloatingActionButton(
              onPressed: () async {
                final selectedTime = await showTimePicker(
                  context: context,
                  initialTime: TimeOfDay.now(),
                );
                if (selectedTime != null) {
                  final title = await _showTitleDialog(context);
                  if (title != null && title.isNotEmpty) {
                    final reminder = Reminder(
                      title: title,
                      hour: selectedTime.hour,
                      minute: selectedTime.minute,
                    );
                    _addReminder(reminder);
                  }
                }
              },
              tooltip: 'Add new',
              child: const Icon(Icons.add,),
            ),
    );
  }

  Future<String?> _showTitleDialog(BuildContext context) async {
    String title = '';
    return await showDialog<String>(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: const Text('Enter Reminder Title'),
          content: TextField(
            onChanged: (value) {
              title = value;
            },
            decoration: const InputDecoration(hintText: 'Title'),
          ),
          actions: <Widget>[
            TextButton(
              onPressed: () {
                Navigator.of(context).pop(title);
              },
              child: const Text('OK'),
            ),
          ],
        );
      },
    );
  }
}
