class Reminder {
  final int? id;
  final String title;
  final int hour;
  final int minute;

  Reminder({
    this.id,
    required this.title,
    required this.hour,
    required this.minute,
  });

  Map<String, dynamic> toMap() {
    return {
      'id': id,
      'title': title,
      'hour': hour,
      'minute': minute,
    };
  }
}
