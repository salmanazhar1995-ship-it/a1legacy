<?php
    $industryItems = ($industries ?? collect())->values();
?>
<?php if($industryItems->isNotEmpty()): ?>
<section id="industries" class="a1-industry-showcase">
    <style>
        .a1-industry-showcase{position:relative;overflow:hidden;border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);padding:96px 24px;background:radial-gradient(circle at 50% 0%,rgba(47,143,255,.10),transparent 36%),rgba(2,7,13,.82);color:#fff}
        .a1-industry-showcase *{box-sizing:border-box}.a1-industry-shell{width:min(1240px,100%);margin:0 auto}.a1-industry-head{display:block;margin-bottom:30px;text-align:center}.a1-industry-copy{max-width:980px;margin:0 auto;text-align:center}
        .a1-industry-kicker{margin:0;color:#8fc5ff;font-family:"Geist Mono",monospace;font-size:11px;font-weight:600;letter-spacing:.18em;text-transform:uppercase;text-align:center}.a1-industry-title{margin:14px auto 0;font-size:clamp(34px,5vw,62px);line-height:1.02;letter-spacing:-.055em;font-weight:600;text-align:center}.a1-industry-intro{max-width:760px;margin:18px auto 0;color:rgba(255,255,255,.48);font-size:15px;line-height:1.8;text-align:center}
        .a1-industry-all{display:inline-flex;margin-top:22px;align-items:center;gap:8px;white-space:nowrap;border:1px solid rgba(158,203,255,.20);border-radius:12px;padding:12px 15px;background:rgba(47,143,255,.06);color:#b9d8ff;font-size:12px;text-decoration:none;transition:.2s}.a1-industry-all:hover{background:rgba(47,143,255,.12);border-color:rgba(158,203,255,.36);color:#fff}
        .a1-industry-layout{display:grid;grid-template-columns:250px 250px minmax(0,1fr);gap:18px;align-items:stretch}.a1-industry-sidebar,.a1-industry-substage{min-width:0}.a1-industry-column-label{margin:0 0 10px;color:rgba(143,197,255,.72);font-family:"Geist Mono",monospace;font-size:9px;font-weight:600;letter-spacing:.16em;text-transform:uppercase}
        .a1-industry-search-wrap{display:block;margin:0 0 12px}.a1-industry-search{position:relative;width:100%}.a1-industry-search svg{position:absolute;left:16px;top:50%;width:18px;height:18px;transform:translateY(-50%);color:rgba(158,203,255,.65);pointer-events:none}.a1-industry-search input{width:100%;height:50px;border:1px solid rgba(158,203,255,.16);border-radius:15px;background:rgba(5,14,24,.88);padding:0 46px;color:#fff;font-size:13px;outline:none;box-shadow:0 18px 45px rgba(0,0,0,.18);transition:border-color .2s,background .2s,box-shadow .2s}.a1-industry-search input::placeholder{color:rgba(255,255,255,.30)}.a1-industry-search input:focus{border-color:rgba(105,174,255,.48);background:#07111d;box-shadow:0 0 0 3px rgba(47,143,255,.08),0 18px 45px rgba(0,0,0,.20)}
        .a1-industry-tabs,.a1-industry-subtabs{display:flex;flex-direction:column;gap:9px;min-width:0;max-height:520px;overflow-y:auto;padding-right:5px;scrollbar-width:thin;scrollbar-color:rgba(158,203,255,.22) transparent}.a1-industry-tab,.a1-industry-subtab{width:100%;appearance:none;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:16px 17px;background:rgba(255,255,255,.018);color:#fff;text-align:left;cursor:pointer;transition:.2s}.a1-industry-tab:hover,.a1-industry-subtab:hover{border-color:rgba(255,255,255,.15);background:rgba(255,255,255,.035)}.a1-industry-tab[aria-selected="true"],.a1-industry-subtab[aria-selected="true"]{border-color:rgba(105,174,255,.42);background:linear-gradient(135deg,rgba(47,143,255,.13),rgba(47,143,255,.035));box-shadow:0 12px 35px rgba(0,0,0,.16),inset 0 0 0 1px rgba(110,180,255,.05)}.a1-industry-tab strong,.a1-industry-subtab strong{display:block;font-size:14px;font-weight:600;letter-spacing:-.01em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.a1-industry-tab[hidden],.a1-industry-subgroup[hidden]{display:none!important}.a1-industry-main-description{margin:0 0 12px;color:rgba(255,255,255,.35);font-size:11px;line-height:1.6}
        .a1-industry-empty{display:none;border:1px dashed rgba(255,255,255,.10);border-radius:14px;padding:18px;text-align:center;color:rgba(255,255,255,.36);font-size:12px;line-height:1.6}.a1-industry-empty.is-visible{display:block}
        .a1-industry-stage{min-width:0}.a1-industry-panel{height:100%;min-height:800px;overflow:hidden;border:1px solid rgba(255,255,255,.085);border-radius:24px;background:radial-gradient(circle at 50% 18%,rgba(47,143,255,.10),transparent 40%),linear-gradient(145deg,#07111d,#040a12 62%);box-shadow:0 24px 70px rgba(0,0,0,.22)}.a1-industry-panel[hidden]{display:none}.a1-industry-panel-copy{display:flex;min-height:800px;flex-direction:column;align-items:stretch;padding:48px;text-align:left}.a1-industry-panel-label{align-self:flex-start;margin:0;border:1px solid rgba(105,173,255,.30);border-radius:999px;padding:9px 13px;background:rgba(47,143,255,.09);color:#8fc5ff;font-family:"Geist Mono",monospace;font-size:9px;font-weight:600;letter-spacing:.15em;text-transform:uppercase}.a1-industry-panel-title{margin:25px 0 0;font-size:clamp(34px,3.5vw,54px);line-height:1.02;letter-spacing:-.05em;font-weight:600;text-align:left}.a1-industry-panel-description{max-width:720px;margin:20px 0 0;color:rgba(255,255,255,.52);font-size:15px;line-height:1.85;text-align:left}.a1-industry-panel-description p{margin-left:0;margin-right:0}
        .a1-industry-opportunity-label{margin:30px 0 0;color:rgba(143,197,255,.58);font-family:"Geist Mono",monospace;font-size:9px;font-weight:600;letter-spacing:.16em;text-transform:uppercase}.a1-industry-points{display:grid;width:100%;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;margin:13px 0 0}.a1-industry-point{display:flex;min-height:68px;align-items:flex-start;gap:10px;border:1px solid rgba(158,203,255,.10);border-radius:14px;padding:15px;background:rgba(4,14,24,.55);color:rgba(255,255,255,.63);font-size:12px;line-height:1.55;text-align:left}.a1-industry-point-index{flex:0 0 auto;color:#69adff;font-family:"Geist Mono",monospace;font-size:11px;font-weight:700}.a1-industry-actions{display:flex;margin-top:28px}.a1-industry-primary{display:inline-flex;min-height:50px;align-items:center;justify-content:space-between;gap:28px;border-radius:13px;padding:13px 20px;background:#8fc5ff;color:#05101c;font-size:12px;font-weight:700;text-decoration:none;box-shadow:0 18px 45px rgba(47,143,255,.14);transition:.2s}.a1-industry-primary:hover{background:#fff;transform:translateY(-1px);box-shadow:0 22px 55px rgba(47,143,255,.22)}
        .a1-industry-journey{margin:42px -48px -48px;padding:34px 48px 42px;border-top:1px solid rgba(255,255,255,.08);background:linear-gradient(180deg,rgba(47,143,255,.025),rgba(47,143,255,.065))}.a1-industry-journey-title{margin:0;text-align:center;color:rgba(143,197,255,.58);font-family:"Geist Mono",monospace;font-size:9px;font-weight:600;letter-spacing:.18em;text-transform:uppercase}.a1-industry-journey-list{display:grid;gap:0;width:min(440px,100%);margin:23px auto 0}.a1-industry-journey-step{position:relative;display:grid;grid-template-columns:38px minmax(0,1fr);gap:13px;align-items:center;border:1px solid rgba(158,203,255,.12);border-radius:16px;padding:15px 17px;background:rgba(3,13,23,.62)}.a1-industry-journey-number{display:flex;height:34px;width:34px;align-items:center;justify-content:center;border-radius:10px;background:rgba(47,143,255,.15);color:#8fc5ff;font-family:"Geist Mono",monospace;font-size:10px;font-weight:700}.a1-industry-journey-step strong{display:block;color:rgba(255,255,255,.88);font-size:12px;font-weight:600}.a1-industry-journey-step p{margin:4px 0 0;color:rgba(255,255,255,.34);font-size:10px;line-height:1.5}.a1-industry-journey-arrow{height:25px;text-align:center;color:rgba(105,173,255,.50);font-size:15px;line-height:25px}.a1-industry-note{width:min(520px,100%);margin:24px auto 0;text-align:center}.a1-industry-note small{display:block;color:rgba(255,255,255,.25);font-family:"Geist Mono",monospace;font-size:8px;letter-spacing:.14em;text-transform:uppercase}.a1-industry-note p{margin:8px 0 0;color:rgba(255,255,255,.36);font-size:10.5px;line-height:1.65}
        @media(max-width:1100px){.a1-industry-layout{grid-template-columns:220px 220px minmax(0,1fr)}.a1-industry-panel-copy{padding:44px 30px}}
        @media(max-width:900px){.a1-industry-layout{grid-template-columns:1fr 1fr}.a1-industry-stage{grid-column:1/-1}.a1-industry-tabs,.a1-industry-subtabs{max-height:340px}.a1-industry-panel,.a1-industry-panel-copy{min-height:0}}
        @media(max-width:700px){.a1-industry-showcase{padding:72px 18px}.a1-industry-layout{grid-template-columns:1fr}.a1-industry-stage{grid-column:auto}.a1-industry-tabs,.a1-industry-subtabs{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));max-height:none;overflow:visible;padding-right:0}.a1-industry-tab,.a1-industry-subtab{padding:14px 13px;text-align:center}.a1-industry-tab strong,.a1-industry-subtab strong{font-size:12px}.a1-industry-panel{min-height:0;border-radius:20px}.a1-industry-panel-copy{min-height:0;padding:34px 20px}.a1-industry-points{grid-template-columns:1fr}.a1-industry-journey{margin:34px -20px -34px;padding:30px 20px 34px}.a1-industry-primary{width:100%}}
        @media(max-width:420px){.a1-industry-showcase{padding-left:14px;padding-right:14px}.a1-industry-tabs,.a1-industry-subtabs{grid-template-columns:1fr}.a1-industry-tab strong,.a1-industry-subtab strong{font-size:13px}}
    </style>

    <div class="a1-industry-shell">
        <div class="a1-industry-head">
            <div class="a1-industry-copy">
                <p class="a1-industry-kicker"><?php echo e($section?->eyebrow ?: 'Industries'); ?></p>
                <h2 class="a1-industry-title"><?php echo e($section?->heading ?: 'See where AI fits in your industry'); ?></h2>
                <?php if($section?->body): ?><div class="a1-industry-intro"><?php echo \App\Support\RichText::render($section->body); ?></div><?php endif; ?>
            </div>
            <a class="a1-industry-all" href="<?php echo e(route('industries.index')); ?>">View all industries <span>&rarr;</span></a>
        </div>

        <div class="a1-industry-layout" data-industry-showcase>
            <div class="a1-industry-sidebar">
                <p class="a1-industry-column-label">Main Industry</p>
                <div class="a1-industry-search-wrap"><label class="a1-industry-search"><span class="sr-only">Search industries</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-3.5-3.5"></path></svg><input type="search" data-industry-search autocomplete="off" placeholder="Search industries..." aria-label="Search industries"></label></div>
                <div class="a1-industry-tabs" role="tablist" aria-label="Main industries">
                    <?php $__currentLoopData = $industryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainIndustry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="a1-industry-tab" data-main-industry="<?php echo e($loop->index); ?>" data-industry-name="<?php echo e(\Illuminate\Support\Str::lower($mainIndustry->name.' '.$mainIndustry->subIndustries->pluck('title')->implode(' '))); ?>" role="tab" aria-selected="<?php echo e($loop->first ? 'true' : 'false'); ?>"><strong><?php echo e($mainIndustry->name); ?></strong></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="a1-industry-empty" data-industry-empty>No industry matches your search.</div>
            </div>

            <div class="a1-industry-substage">
                <p class="a1-industry-column-label">Sub Industry</p>
                <div class="a1-industry-search-wrap"><label class="a1-industry-search"><span class="sr-only">Search sub industries</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-3.5-3.5"></path></svg><input type="search" data-sub-industry-search autocomplete="off" placeholder="Search sub industries..." aria-label="Search sub industries"></label></div>
                <?php $__currentLoopData = $industryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainIndustry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="a1-industry-subgroup" data-sub-industry-group="<?php echo e($loop->index); ?>" <?php if(!$loop->first): ?> hidden <?php endif; ?>>
                        <?php if($mainIndustry->description): ?><p class="a1-industry-main-description"><?php echo e($mainIndustry->description); ?></p><?php endif; ?>
                        <div class="a1-industry-subtabs" role="tablist" aria-label="<?php echo e($mainIndustry->name); ?> sub industries">
                            <?php $__currentLoopData = $mainIndustry->subIndustries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subIndustry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" class="a1-industry-subtab" data-sub-industry="<?php echo e($loop->parent->index); ?>:<?php echo e($loop->index); ?>" data-sub-industry-name="<?php echo e(\Illuminate\Support\Str::lower($subIndustry->title.' '.$subIndustry->category)); ?>" role="tab" aria-selected="<?php echo e($loop->parent->first && $loop->first ? 'true' : 'false'); ?>"><strong><?php echo e($subIndustry->title); ?></strong></button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="a1-industry-empty" data-sub-industry-empty>No sub industry matches your search.</div>
            </div>

            <div class="a1-industry-stage">
                <?php $__currentLoopData = $industryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainIndustry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $mainIndustry->subIndustries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subIndustry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            // Fully dynamic: only admin-managed highlights are shown here.
                            $aiOpportunities = collect($subIndustry->highlights)->filter()->values();
                            $journeySteps = [
                                ['New enquiry', 'Phone, website, chat, social or campaign lead.'],
                                ['AI responds & qualifies', 'Answers questions and gathers the right information.'],
                                ['CRM updates automatically', 'Contact, notes, stage, owner and follow-up stay in sync.'],
                                ['Next action happens', 'Booking, quote, human handoff, reminder or nurture.'],
                            ];
                        ?>
                        <article class="a1-industry-panel" data-industry-panel="<?php echo e($loop->parent->index); ?>:<?php echo e($loop->index); ?>" <?php if(!$loop->parent->first || !$loop->first): ?> hidden <?php endif; ?>>
                            <div class="a1-industry-panel-copy">
                                <p class="a1-industry-panel-label"><?php echo e($subIndustry->category ?: $mainIndustry->name); ?></p>
                                <h3 class="a1-industry-panel-title"><?php echo e($subIndustry->title); ?></h3>
                                <?php if($subIndustry->description): ?><div class="a1-industry-panel-description"><?php echo \App\Support\RichText::render($subIndustry->description); ?></div><?php endif; ?>
                                <?php if($aiOpportunities->isNotEmpty()): ?>
                                    <p class="a1-industry-opportunity-label">Where AI can work in this business</p>
                                    <div class="a1-industry-points">
                                        <?php $__currentLoopData = $aiOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="a1-industry-point"><span class="a1-industry-point-index"><?php echo e(str_pad((string) ($loop->index + 1), 2, '0', STR_PAD_LEFT)); ?></span><span><?php echo e($highlight); ?></span></div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                              

                                <div class="a1-industry-journey">
                                    <p class="a1-industry-journey-title">Example AI customer journey</p>
                                    <div class="a1-industry-journey-list">
                                        <?php $__currentLoopData = $journeySteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $journeyStep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="a1-industry-journey-step">
                                                <span class="a1-industry-journey-number"><?php echo e(str_pad((string) ($loop->index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                                                <div><strong><?php echo e($journeyStep[0]); ?></strong><p><?php echo e($journeyStep[1]); ?></p></div>
                                            </div>
                                            <?php if (! ($loop->last)): ?><div class="a1-industry-journey-arrow" aria-hidden="true">&darr;</div><?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php if($subIndustry->system_note): ?><div class="a1-industry-note"><small>Fits around your current stack</small><p><?php echo e($subIndustry->system_note); ?></p></div><?php endif; ?>
                                </div>
                            <div class="a1-industry-actions p-2" ><a class="a1-industry-primary" style="margin:auto" href="<?php echo e(route('industries.show', $subIndustry->slug)); ?>"><span>See how AI works for this business</span><span>&rarr;</span></a></div>    
                            </div>
                              
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<script>
(function(){
    const root=document.querySelector('[data-industry-showcase]');
    if(!root||root.dataset.ready==='1') return;
    root.dataset.ready='1';
    const mains=[...root.querySelectorAll('[data-main-industry]')];
    const groups=[...root.querySelectorAll('[data-sub-industry-group]')];
    const subs=[...root.querySelectorAll('[data-sub-industry]')];
    const panels=[...root.querySelectorAll('[data-industry-panel]')];
    const search=root.querySelector('[data-industry-search]');
    const subSearch=root.querySelector('[data-sub-industry-search]');
    const empty=root.querySelector('[data-industry-empty]');
    const subEmpty=root.querySelector('[data-sub-industry-empty]');
    function activateSub(key){subs.forEach((button)=>button.setAttribute('aria-selected',button.dataset.subIndustry===key?'true':'false'));panels.forEach((panel)=>{panel.hidden=panel.dataset.industryPanel!==key;});}
    function filterSubIndustries(index){
        const group=groups.find((item)=>item.dataset.subIndustryGroup===index);
        const query=(subSearch?.value||'').trim().toLowerCase();
        const groupSubs=group?[...group.querySelectorAll('[data-sub-industry]')]:[];
        groupSubs.forEach((button)=>{button.hidden=query!==''&&!(button.dataset.subIndustryName||'').includes(query);});
        const visible=groupSubs.filter((button)=>!button.hidden);
        if(subEmpty)subEmpty.classList.toggle('is-visible',visible.length===0);
        if(visible.length===0){panels.forEach((panel)=>{panel.hidden=true;});return;}
        const selected=visible.find((button)=>button.getAttribute('aria-selected')==='true');
        activateSub((selected||visible[0]).dataset.subIndustry);
    }
    function activateMain(index){index=String(index);mains.forEach((button)=>button.setAttribute('aria-selected',button.dataset.mainIndustry===index?'true':'false'));groups.forEach((group)=>{group.hidden=group.dataset.subIndustryGroup!==index;});filterSubIndustries(index);}
    mains.forEach((button)=>button.addEventListener('click',()=>activateMain(button.dataset.mainIndustry)));
    subs.forEach((button)=>button.addEventListener('click',()=>activateSub(button.dataset.subIndustry)));
    if(search)search.addEventListener('input',()=>{const query=search.value.trim().toLowerCase();mains.forEach((button)=>{button.hidden=query!==''&&!(button.dataset.industryName||'').includes(query);});const visible=mains.filter((button)=>!button.hidden);if(empty)empty.classList.toggle('is-visible',visible.length===0);if(visible.length===0){groups.forEach((group)=>{group.hidden=true;});panels.forEach((panel)=>{panel.hidden=true;});return;}const selected=mains.find((button)=>button.getAttribute('aria-selected')==='true'&&!button.hidden);activateMain((selected||visible[0]).dataset.mainIndustry);});
    if(subSearch)subSearch.addEventListener('input',()=>{const selected=mains.find((button)=>button.getAttribute('aria-selected')==='true');if(selected)filterSubIndustries(selected.dataset.mainIndustry);});
})();
</script>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/site/sections/business-showcase.blade.php ENDPATH**/ ?>