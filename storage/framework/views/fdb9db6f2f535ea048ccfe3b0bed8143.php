<?php if (isset($component)) { $__componentOriginal843ce966af9a4617c82cfd0251e8de06 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal843ce966af9a4617c82cfd0251e8de06 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.email-layout','data' => ['siteName' => $siteName,'eyebrow' => 'Consultation request received','title' => 'Thanks, '.$contactMessage->name,'preheader' => 'We received your AI & automation consultation request.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('email-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['site-name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($siteName),'eyebrow' => 'Consultation request received','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Thanks, '.$contactMessage->name),'preheader' => 'We received your AI & automation consultation request.']); ?>
    <p style="margin:0 0 18px;">Hello <?php echo e($contactMessage->name); ?>,</p>
    <p style="margin:0 0 24px;">Thank you for contacting <?php echo e($siteName); ?>. We received your AI & automation consultation request and will review your business, current systems and priorities before following up.</p>

    <div style="padding:22px; border:1px solid #e1e8f1; border-radius:14px; background:#f8fafc;">
        <p style="margin:0 0 9px; color:#8491a4; font-size:11px; font-weight:800; letter-spacing:1.2px; text-transform:uppercase;">Request summary</p>
        <p style="margin:0 0 8px; color:#34445d;"><strong>Industry:</strong> <?php echo e($contactMessage->displayIndustry() ?: 'Not provided'); ?></p>
        <p style="margin:0 0 8px; color:#34445d;"><strong>Interest:</strong> <?php echo e($contactMessage->displayServiceInterest() ?: 'Not provided'); ?></p>
        <p style="margin:0; color:#34445d;"><strong>Timeline:</strong> <?php echo e($contactMessage->project_timeline ?: 'Not provided'); ?></p>
    </div>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:24px; width:100%;"><tr><td style="padding:16px 18px; border-radius:12px; background:#eef6ff; color:#38506f; font-size:13px; line-height:1.6;"><strong style="color:#1877f2;">What happens next?</strong><br>A member of our team will reply using your preferred contact method where possible. We’ll use the details you submitted only to review and respond to your enquiry.</td></tr></table>

    <p style="margin:26px 0 0;">Warm regards,<br><strong style="color:#17233c;">The <?php echo e($siteName); ?> team</strong></p>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\mail\contact\client.blade.php ENDPATH**/ ?>