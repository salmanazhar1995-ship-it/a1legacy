New AI consultation request | <?php echo e($siteName); ?>


A new AI & automation consultation request was submitted and saved in your Admin Inbox.

Name: <?php echo e($contactMessage->name); ?>

Email: <?php echo e($contactMessage->email); ?>

Phone / WhatsApp: <?php echo e($contactMessage->phone ?: 'Not provided'); ?>

Company: <?php echo e($contactMessage->company ?: 'Not provided'); ?>

Website: <?php echo e($contactMessage->website_url ?: 'Not provided'); ?>

Role: <?php echo e($contactMessage->displayRole() ?: 'Not provided'); ?>

Decision maker: <?php echo e($contactMessage->decision_maker ?: 'Not provided'); ?>

Country: <?php echo e($contactMessage->displayCountry() ?: 'Not provided'); ?>

Industry: <?php echo e($contactMessage->displayIndustry() ?: 'Not provided'); ?>

Company size: <?php echo e($contactMessage->company_size ?: 'Not provided'); ?>

Annual turnover: <?php echo e($contactMessage->annual_turnover ?: 'Not provided'); ?>

Monthly leads: <?php echo e($contactMessage->monthly_leads ?: 'Not provided'); ?>

Current CRM / platform: <?php echo e($contactMessage->displayCrm() ?: 'Not provided'); ?>

Service interest: <?php echo e($contactMessage->displayServiceInterest() ?: 'Not provided'); ?>

Main challenge: <?php echo e($contactMessage->displayBusinessChallenge() ?: 'Not provided'); ?>

Preferred contact method: <?php echo e($contactMessage->preferred_contact_method ?: 'Not provided'); ?>

Time zone: <?php echo e($contactMessage->displayTimeZone() ?: 'Not provided'); ?>

Project timeline: <?php echo e($contactMessage->project_timeline ?: 'Not provided'); ?>


What they want to automate:
<?php echo e($contactMessage->message ?: 'Not provided'); ?>


Open in Admin Inbox: <?php echo e(route('admin.messages.show', $contactMessage)); ?>

<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\mail\contact\admin-text.blade.php ENDPATH**/ ?>