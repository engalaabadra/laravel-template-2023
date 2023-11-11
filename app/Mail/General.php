<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;



class General extends Mailable
{
    use Queueable, SerializesModels;
    public $emailData=[];

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->emailData['email']=$data['email'];
        $this->emailData['type']=$data['type'];
        $this->emailData['code'] =  $data['code'];
        $this->emailData['role']= $data['role'];
        $this->emailData['to']= $data['to'];
        $this->emailData['user'] = $data['user'];
        $this->emailData['user_birth_date'] = $data['user_birth_date'];
        $this->emailData['doctor'] = $data['doctor'];
        $this->emailData['reservation_date'] = $data['reservation_date'];
        $this->emailData['reservation_start_time'] = $data['reservation_start_time'];
        $this->emailData['reservation_end_time'] = $data['reservation_end_time'];
        $this->emailData['reservation_problem'] = $data['reservation_problem'];
        $this->emailData['old_reservation_start_time'] = $data['old_reservation_start_time'];
        $this->emailData['old_reservation_end_time'] = $data['old_reservation_end_time'];
        $this->emailData['old_reservation_date'] = $data['old_reservation_date'];

   
    }

        /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if($this->emailData['type'] == 'welcome') return new Envelope(subject: 'ترحيب بك في تطبيق تلبينة');
            
        // if($this->emailData['type'] == 'welcome'){
        //     if($this->emailData['to'] == 'user') return new Envelope(subject: 'ترحيب بك في تطبيق تلبينة');
        //     if($this->emailData['to'] == 'doctor') return new Envelope(subject: 'ترحيب بك في تطبيق تلبينة');
        // } 
        if($this->emailData['type'] == 'check-code') return new Envelope(subject: 'Check Code');
        if($this->emailData['type'] == 'new-reservation'){
            if($this->emailData['to'] == 'user') return new Envelope(subject: 'حجز جديد في تطبيق تلبينة');
            if($this->emailData['to'] == 'doctor') return new Envelope(subject: 'حجز جديد في تطبيق تلبينة');
        } 
        if($this->emailData['type'] == 'reminder-reservation') return new Envelope(subject: 'تذكير بموعد في تطبيق تلبينة');
        if($this->emailData['type'] == 'rescheduling-reservation'){
            if($this->emailData['role'] == 'user') return new Envelope(subject: 'اعادة جدولة لموعد في تطبيق تلبينة');
            if($this->emailData['role'] == 'doctor') return new Envelope(subject: 'اعادة جدولة لموعد في تطبيق تلبينة');
        } 
        if($this->emailData['type'] == 'cancel-reservation'){
            if($this->emailData['role'] == 'user') return new Envelope(subject: 'آلغاء موعد في تطبيق تلبينة');
            if($this->emailData['role'] == 'doctor') return new Envelope(subject: 'آلغاء موعد في تطبيق تلبينة');
        } 
        //  return new Envelope(subject: 'Check Code');
    }

    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->emailData['type'] == 'welcome') return $this->view('emails.welcome-user')->subject('WelcomeUser')->with($this->emailData);
           
    //     if($this->emailData['type'] == 'welcome'){
    //         if($this->emailData['to'] == 'user') return $this->view('emails.welcome-user')->subject('WelcomeUser')->with($this->emailData);
    //         if($this->emailData['to'] == 'doctor') return $this->view('emails.welcome-doctor')->subject('WelcomeDoctor')->with($this->emailData);
    //    } 
        if($this->emailData['type'] == 'check-code')  return $this->view('emails.check-code')->subject('CheckCode')->with($this->emailData);
        if($this->emailData['type'] == 'new-reservation'){
             if($this->emailData['to'] == 'user') return $this->view('emails.new-reservation-to-user')->subject('NewReservation')->with($this->emailData);
             if($this->emailData['to'] == 'doctor') return $this->view('emails.new-reservation-to-doctor')->subject('NewReservation')->with($this->emailData);
        }  
        if($this->emailData['type'] == 'reminder-reservation') {
            if($this->emailData['to'] == 'user')  return $this->view('emails.reminder-reservation-to-user')->subject('ReminderReservation')->with($this->emailData);
            if($this->emailData['to'] == 'doctor') return $this->view('emails.reminder-reservation-to-doctor')->subject('ReminderReservation')->with($this->emailData);
        }
        
        
        if($this->emailData['type'] == 'rescheduling-reservation'){
            if($this->emailData['role'] == 'user') return $this->view('emails.rescheduling-reservation-by-user')->subject('ReschedulingReservationByUser')->with($this->emailData);
            if($this->emailData['role'] == 'doctor') return $this->view('emails.rescheduling-reservation-by-doctor')->subject('ReschedulingReservationByDoctor')->with($this->emailData);
        }
        
        if($this->emailData['type'] == 'cancel-reservation'){
            if($this->emailData['role'] == 'user') return $this->view('emails.cancel-reservation-by-user')->subject('CancelReservationByUser')->with($this->emailData);
            if($this->emailData['role'] == 'doctor') return $this->view('emails.cancel-reservation-by-doctor')->subject('CancelReservationByDoctor')->with($this->emailData);
        }  
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if($this->emailData['type'] == 'welcome'){
            if($this->emailData['to'] == 'user') return new Content(view: 'emails.welcome-user');
            if($this->emailData['to'] == 'doctor') return new Content(view: 'emails.welcome-doctor');
        }
        if($this->emailData['type'] == 'check-code')  return new Content(view: 'emails.check-code');
        if($this->emailData['type'] == 'new-reservation'){
            if($this->emailData['to'] == 'user') return new Content(view: 'emails.new-reservation-to-user');
            if($this->emailData['to'] == 'doctor') return new Content(view: 'emails.new-reservation-to-doctor');
        }  
        if($this->emailData['type'] == 'reminder-reservation'){
            if($this->emailData['to'] == 'user') return new Content(view: 'emails.reminder-reservation-to-user');
            if($this->emailData['to'] == 'doctor') return new Content(view: 'emails.reminder-reservation-to-doctor');
        }
        if($this->emailData['type'] == 'cancel-reservation'){
            if($this->emailData['role'] == 'user') return new Content(view: 'emails.cancel-reservation-by-user');
            if($this->emailData['role'] == 'doctor') return new Content(view: 'emails.cancel-reservation-by-doctor');
        }
        if($this->emailData['type'] == 'rescheduling-reservation'){
            if($this->emailData['role'] == 'user') return new Content(view: 'emails.rescheduling-reservation-by-user');
            if($this->emailData['role'] == 'doctor') return new Content(view: 'emails.rescheduling-reservation-by-doctor');
        }  
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
