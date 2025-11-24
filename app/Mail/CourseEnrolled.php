<?php
namespace App\Mail;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseEnrolled extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $course;
    public $password;
 public $signedLoginUrl;
    public function __construct(Student $student, Course $course, $password = null,$signedLoginUrl = null)
    {
        $this->student = $student;
        $this->course = $course;
        $this->password = $password;
        $this->signedLoginUrl = $signedLoginUrl;
    }

    public function build()
    {
        return $this->subject('Course Enrollment Confirmation')
                    ->view('emails.course_enrolled');
    }
}
