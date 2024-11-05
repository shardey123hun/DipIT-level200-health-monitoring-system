import 'package:sqflite/sqflite.dart';
import 'package:path/path.dart';
import '../models/reminder.dart';

class DBHelper {
  static final DBHelper _instance = DBHelper._internal();
  factory DBHelper() => _instance;
  DBHelper._internal();

  static Database? _database;

  Future<Database> get database async {
    if (_database != null) return _database!;
    _database = await _initDB();
    return _database!;
  }

  Future<Database> _initDB() async {
    String path = join(await getDatabasesPath(), 'reminder.db');
    return await openDatabase(
      path,
      onCreate: (db, version) async {
        await db.execute('''
          CREATE TABLE reminders (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT,
            hour INTEGER,
            minute INTEGER
          )
        ''');
      },
      version: 1,
    );
  }

  Future<int> insertReminder(Reminder reminder) async {
    final db = await database;
    return await db.insert('reminders', reminder.toMap());
  }

  Future<List<Reminder>> getReminders() async {
    final db = await database;
    final List<Map<String, dynamic>> maps = await db.query('reminders');
    return List.generate(maps.length, (i) {
      return Reminder(
        id: maps[i]['id'],
        title: maps[i]['title'],
        hour: maps[i]['hour'],
        minute: maps[i]['minute'],
      );
    });
  }

  Future<void> deleteReminder(int id) async {
    final db = await database;
    await db.delete(
      'reminders',
      where: 'id = ?',
      whereArgs: [id],
    );
  }
}
