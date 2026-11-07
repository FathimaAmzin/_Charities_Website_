<?php

namespace App\Mail;

use App\Models\CourseRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestDecisionMail extends Mailable
{
    use Queueable, SerializesModels;

    public CourseRequest $courseRequest;
    public string $decision; // 'approved' or 'rejected'
    public ?string $adminNotes;

    /**
     * Create a new message instance.
     */
    public function __construct(CourseRequest $courseRequest, string $decision, ?string $adminNotes = null)
    {
        $this->courseRequest = $courseRequest;
        $this->decision = $decision;
        $this->adminNotes = $adminNotes;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $programType = $this->courseRequest->type === 'course' ? 'Course Enrollment' : 'Humanitarian Assistance Request';
        $courseTitle = $this->courseRequest->course_title;

        if ($this->decision === 'approved') {
            $subject = '🎉 Application Approved: ' . $courseTitle . ' | SDC Sri Lanka';
        } else {
            $subject = 'Application Status Update: ' . $courseTitle . ' | SDC Sri Lanka';
        }

        return $this->subject($subject)
            ->view('emails.request_decision');
    }
}

