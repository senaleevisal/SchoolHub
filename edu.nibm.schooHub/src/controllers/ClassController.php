<?php

class ClassController
{


    //fetch class by id
    public function fetchClassById($classId)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT class_id, name, year, school_id FROM classes WHERE class_id = ?");
        $stmt->execute([$classId]);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fetch all classes
    public function fetchClasses()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT class_id, name, year, school_id FROM classes ORDER BY year DESC, name ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $classes = [];
        while ($row = $result->fetch_assoc()) {
            $classes[] = $row;
        }
        return $classes;
    }

    public function addClass($name, $year, $schoolId)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO classes (name, year, school_id) VALUES (?, ?, ?)");
        $stmt->execute([$name, $year, $schoolId]);
        return $stmt->affected_rows;
    }



    // Update an existing class
    public function updateClass($classId, $name, $year, $schoolId)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE classes SET name = ?, year = ?, school_id = ? WHERE class_id = ?");
        $stmt->execute([$name, $year, $schoolId, $classId]);
        return $stmt->affected_rows;
    }

    // Delete a class
    public function deleteClass($classId)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM classes WHERE class_id = ?");
        $stmt->execute([$classId]);
        return $stmt->get_warnings();
    }

    // Fetch all students in a class
    public function getClass($classId)
    {
        global $conn;
        $sql = "SELECT u.* FROM users u 
            JOIN class_students cs ON u.user_id = cs.student_id 
            WHERE cs.class_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            // Handle error, e.g., log it or throw an exception
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        $stmt->bind_param("i", $classId);
        $stmt->execute();
        $result = $stmt->get_result();

        $userDetails = [];
        while ($row = $result->fetch_assoc()) {
            $userDetails[] = $row;
        }

        $stmt->close(); // Close the statement
        return $userDetails;
    }

    // Fetch all teachers in a class
    public function getClasses($classId)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT teacher_id FROM class_teachers WHERE class_id = ?");
        $stmt->execute([$classId]);
        $result = $stmt->get_result();
        $teachers = [];
        while ($row = $result->fetch_assoc()) {
            $teachers[] = $row;
        }
        return $teachers;
    }
    // Add a student to a class
    public function addStudentToClass($classId, $studentId)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO class_students (class_id, student_id) VALUES (?, ?)");
        $stmt->execute([$classId, $studentId]);
        return $stmt->affected_rows;
    }

    // Remove a student from a class
    public function removeStudentFromClass($classId, $studentId)
    {
        global $conn;
        $stmt = $this->$conn->prepare("DELETE FROM class_students WHERE class_id = ? AND student_id = ?");
        $stmt->execute([$classId, $studentId]);
        return $stmt->rowCount();
    }

    // Add a teacher to a class
    public function addTeacherToClass($classId, $teacherId)
    {
        global $conn;
        $stmt = $this->$conn->prepare("INSERT INTO class_teachers (class_id, teacher_id) VALUES (?, ?)");
        $stmt->execute([$classId, $teacherId]);
        return $stmt->rowCount();
    }

    // Remove a teacher from a class
    public function removeTeacherFromClass($classId, $teacherId)
    {
        global $conn;
        $stmt = $this->$conn->prepare("DELETE FROM class_teachers WHERE class_id = ? AND teacher_id = ?");
        $stmt->execute([$classId, $teacherId]);
        return $stmt->rowCount();
    }
}
