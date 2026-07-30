<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if(isset($_POST['save'])){

    $class_id     = $_POST['class_id'];
    $subject_id   = $_POST['subject_id'];
    $teacher_id   = $_POST['teacher_id'];
    $day_of_week  = $_POST['day_of_week'];
    $lesson_time  = trim($_POST['lesson_time']);

    $stmt = $pdo->prepare("
        INSERT INTO timetable
        (class_id, subject_id, teacher_id, day_of_week, lesson_time)
        VALUES (?,?,?,?,?)
    ");

    $stmt->execute([
        $class_id,
        $subject_id,
        $teacher_id,
        $day_of_week,
        $lesson_time
    ]);

    header("Location: timetable.php");
    exit;
}

$classes = $pdo->query("
SELECT id,class_name
FROM classes
ORDER BY class_name
")->fetchAll(PDO::FETCH_ASSOC);

$subjects = $pdo->query("
SELECT id,subject_name
FROM subjects
ORDER BY subject_name
")->fetchAll(PDO::FETCH_ASSOC);

$teachers = $pdo->query("
SELECT id,full_name
FROM teachers
ORDER BY full_name
")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="mb-4">إضافة حصة جديدة</h2>

<form method="post">

<div class="mb-3">
<label class="form-label">القسم</label>

<select name="class_id" class="form-control" required>

<?php foreach($classes as $class): ?>

<option value="<?= $class['id']; ?>">
<?= htmlspecialchars($class['class_name']); ?>
</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">المادة</label>

<select name="subject_id" class="form-control" required>

<?php foreach($subjects as $subject): ?>

<option value="<?= $subject['id']; ?>">
<?= htmlspecialchars($subject['subject_name']); ?>
</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">الأستاذ</label>

<select name="teacher_id" class="form-control" required>

<?php foreach($teachers as $teacher): ?>

<option value="<?= $teacher['id']; ?>">
<?= htmlspecialchars($teacher['full_name']); ?>
</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">اليوم</label>

<select name="day_of_week" class="form-control">

<option value="الأحد">الأحد</option>
<option value="الإثنين">الإثنين</option>
<option value="الثلاثاء">الثلاثاء</option>
<option value="الأربعاء">الأربعاء</option>
<option value="الخميس">الخميس</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">التوقيت</label>

<input
type="text"
name="lesson_time"
class="form-control"
placeholder="08:00 - 09:00"
required>

</div>

<button
type="submit"
name="save"
class="btn btn-success">

💾 حفظ الحصة

</button>

<a
href="timetable.php"
class="btn btn-secondary">

رجوع

</a>

</form>

<?php
require_once "../../includes/footer.php";
?>