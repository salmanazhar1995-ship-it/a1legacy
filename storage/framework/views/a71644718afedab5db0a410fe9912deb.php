<?php if (isset($component)) { $__componentOriginal843ce966af9a4617c82cfd0251e8de06 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal843ce966af9a4617c82cfd0251e8de06 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.email-layout','data' => ['siteName' => $siteName,'eyebrow' => 'New consultation request','title' => 'AI & automation request from '.$contactMessage->name,'preheader' => 'New consultation request from '.$contactMessage->name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('email-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['site-name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($siteName),'eyebrow' => 'New consultation request','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('AI & automation request from '.$contactMessage->name),'preheader' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('New consultation request from '.$contactMessage->name)]); ?>
    <p style="margin:0 0 24px;">A new AI & automation consultation request was submitted. The complete request is saved in your Admin Inbox.</p>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%; border:1px solid #e1e8f1; border-radius:14px; border-collapse:separate; overflow:hidden; background:#f8fafc;">
        <?php $__currentLoopData = [
            'Name' => $contactMessage->name,
            'Email' => $contactMessage->email,
            'Phone / WhatsApp' => $contactMessage->phone,
            'Company' => $contactMessage->company,
            'Website' => $contactMessage->website_url,
            'Role' => $contactMessage->displayRole(),
            'Country' => $contactMessage->displayCountry(),
            'Industry' => $contactMessage->displayIndustry(),
            'Company size' => $contactMessage->company_size,
            'Annual turnover' => $contactMessage->annual_turnover,
            'Monthly leads' => $contactMessage->monthly_leads,
            'Current CRM / platform' => $contactMessage->displayCrm(),
            'Service interest' => $contactMessage->displayServiceInterest(),
            'Main challenge' => $contactMessage->displayBusinessChallenge(),
            'Preferred contact' => $contactMessage->preferred_contact_method,
            'Time zone' => $contactMessage->displayTimeZone(),
            'Project timeline' => $contactMessage->project_timeline,
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td width="34%" style="padding:12px 18px; border-bottom:1px solid #e5ebf3; color:#8491a4; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.7px;"><?php echo e($label); ?></td>
                <td style="padding:12px 18px; border-bottom:1px solid #e5ebf3; color:#17233c; font-size:13px; text-align:right;"><?php echo e($value ?: 'Not provided'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <?php if($contactMessage->message): ?>
        <div style="margin-top:24px; padding:20px; border-left:4px solid #1877f2; border-radius:4px 12px 12px 4px; background:#f2f7fd;">
            <p style="margin:0 0 8px; color:#8491a4; font-size:11px; font-weight:800; letter-spacing:1.2px; text-transform:uppercase;">What they want to automate</p>
            <p style="margin:0; color:#34445d; white-space:pre-line;"><?php echo e($contactMessage->message); ?></p>
        </div>
    <?php endif; ?>

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin-top:30px;"><tr><td style="border-radius:10px; background:#1877f2;"><a href="<?php echo e(route('admin.messages.show', $contactMessage)); ?>" style="display:inline-block; padding:13px 22px; color:#ffffff; font-size:14px; font-weight:700; text-decoration:none;">Open consultation in Admin →</a></td></tr></table>
    <p style="margin:20px 0 0; color:#8491a4; font-size:12px;">Reply directly to this email to respond to <?php echo e($contactMessage->name); ?>.</p>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal843ce966af9a4617c82cfd0251e8de06)): ?>
<?php $attributes = $__attributesOriginal843ce966af9a4617c82cfd0251e8de06; ?>
<?php unset($__attributesOriginal843ce966af9a4617c82cfd0251e8de06); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal843ce966af9a4617c82cfd0251e8de06)): ?>
<?php $component = $__componentOriginal843ce966af9a4617c82cfd0251e8de06; ?>
<?php unset($__componentOriginal843ce966af9a4617c82cfd0251e8de06); ?>
<?php endif; ?>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\mail\contact\admin.blade.php ENDPATH**/ ?>