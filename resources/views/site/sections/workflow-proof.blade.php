<div id="a1WorkflowEmbed" class="a1-workflow-embed">
<style>
#a1WorkflowEmbed{
  --bg:#02060b;--panel:#03101a;--panel2:#020910;--panel3:#04111c;
  --line:rgba(107,158,194,.16);--line2:rgba(83,186,255,.35);
  --text:#eef7fd;--muted:#718391;--muted2:#8799a5;
  --blue:#66d6ff;--blue2:#1598ff;--green:#63dfa9;--danger:#ff9d8d;
  --radius:20px;
  width:100%; color:var(--text); font-family:Inter,ui-sans-serif,-apple-system,BlinkMacSystemFont,"Segoe UI",Arial,sans-serif; line-height:1.5;
}
#a1WorkflowEmbed *{box-sizing:border-box}
#a1WorkflowEmbed button{font:inherit;color:inherit}
#a1WorkflowEmbed button:focus-visible{outline:2px solid var(--blue);outline-offset:2px}
#a1WorkflowEmbed .workflow-section-head{max-width:800px;margin:0 auto 48px;padding:84px 20px 0;text-align:center}
#a1WorkflowEmbed .workflow-eyebrow{display:inline-flex;align-items:center;gap:9px;font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:#9fc7df;font-weight:750}
#a1WorkflowEmbed .workflow-eyebrow:before{content:"";width:22px;height:1px;background:linear-gradient(90deg,var(--blue),transparent)}
#a1WorkflowEmbed .workflow-section-head h2{font-size:clamp(36px,5vw,62px);line-height:1.02;letter-spacing:-.05em;font-weight:500;margin:16px 0 18px;color:var(--text)}
#a1WorkflowEmbed .workflow-section-head p{color:var(--muted);font-size:14px;line-height:1.75;max-width:720px;margin:0 auto}
#a1WorkflowEmbed .proof-shell{width:min(1560px,100%);margin:auto;border:1px solid var(--line);border-radius:var(--radius);overflow:hidden;background:linear-gradient(180deg,#04111a 0%,#02080e 100%);box-shadow:0 28px 110px rgba(0,0,0,.34)}
#a1WorkflowEmbed .niche-select{padding:24px 32px 20px;border-bottom:1px solid var(--line);background:#020a11}
#a1WorkflowEmbed .niche-select-head{display:flex;align-items:end;justify-content:space-between;gap:16px;margin-bottom:13px}
#a1WorkflowEmbed .niche-select-head b{display:block;font-size:9px;letter-spacing:.16em;text-transform:uppercase;color:#7e9aad}
#a1WorkflowEmbed .niche-select-head span{font-size:9px;color:#536b79}
#a1WorkflowEmbed .niche-track{display:flex;flex-wrap:wrap;gap:8px;padding:1px 0 6px}
#a1WorkflowEmbed .niche-btn{flex:0 0 auto;border:1px solid var(--line);background:#030b12;color:#7d919f;min-height:42px;padding:10px 13px;cursor:pointer;font-size:9px;letter-spacing:.02em;white-space:nowrap;transition:border-color .18s,background .18s,color .18s}
#a1WorkflowEmbed .niche-btn.active{border-color:var(--line2);background:rgba(19,112,183,.10);color:#dff6ff}
#a1WorkflowEmbed .proof-body{display:grid;grid-template-columns:36% 64%;min-height:720px}
#a1WorkflowEmbed .config{border-right:1px solid var(--line);padding:32px}
#a1WorkflowEmbed .control-label{font-size:8px;letter-spacing:.16em;text-transform:uppercase;color:#638094;margin:0 0 10px}
#a1WorkflowEmbed .source-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:26px}
#a1WorkflowEmbed .source-btn,#a1WorkflowEmbed .flow-btn{border:1px solid var(--line);background:#030b12;color:#7d919f;min-height:52px;padding:12px 14px;cursor:pointer;text-align:left;transition:border-color .18s,background .18s,color .18s}
#a1WorkflowEmbed .source-btn{display:flex;align-items:center;gap:9px;font-size:10px}
#a1WorkflowEmbed .source-btn:last-child{grid-column:1/-1}
#a1WorkflowEmbed .source-btn .dot{width:6px;height:6px;border-radius:50%;border:1px solid #547383;flex:0 0 auto}
#a1WorkflowEmbed .source-btn.active,#a1WorkflowEmbed .flow-btn.active{border-color:var(--line2);background:rgba(19,112,183,.10);color:#dff6ff}
#a1WorkflowEmbed .source-btn.active .dot{background:var(--blue);border-color:var(--blue);box-shadow:0 0 10px rgba(89,211,255,.42)}
#a1WorkflowEmbed .flow-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:30px}
#a1WorkflowEmbed .flow-btn{font-size:11px;min-height:58px}
#a1WorkflowEmbed .flow-btn small{display:block;margin-top:4px;color:#607988;font-size:8px;letter-spacing:.04em}
#a1WorkflowEmbed .flow-btn.active[data-flow="emergency"]{border-color:rgba(255,133,111,.37);background:rgba(142,49,36,.08);color:#ffd9d2}
#a1WorkflowEmbed .divider{border:0;border-top:1px solid var(--line);margin:0 0 23px}
#a1WorkflowEmbed .demo-summary small{display:block;color:#638094;font-size:8px;letter-spacing:.16em;text-transform:uppercase;margin-bottom:13px}
#a1WorkflowEmbed .demo-summary p{font-size:11px;color:var(--muted2);line-height:1.75;margin:0}
#a1WorkflowEmbed .selected-setup{margin-top:28px;border:1px solid var(--line);background:#02090f;padding:14px}
#a1WorkflowEmbed .selected-setup span{display:block;font-size:8px;color:#60798a;text-transform:uppercase;letter-spacing:.13em;margin-bottom:8px}
#a1WorkflowEmbed .selected-setup strong{display:block;font-size:10px;color:#bcd1dd;font-weight:560;line-height:1.6}
#a1WorkflowEmbed .run-area{padding:32px;display:flex;flex-direction:column;min-width:0}
#a1WorkflowEmbed .architecture{display:grid;grid-template-columns:repeat(5,1fr);gap:9px;margin-bottom:25px}
#a1WorkflowEmbed .stage{appearance:none;width:100%;border:1px solid var(--line);background:#030b12;padding:13px 12px;min-height:112px;text-align:left;cursor:pointer;transition:border-color .2s,background .2s,box-shadow .2s;min-width:0}
#a1WorkflowEmbed .stage b{display:block;font-size:8px;color:#607b8c;letter-spacing:.04em;margin-bottom:11px}
#a1WorkflowEmbed .stage span{display:block;font-size:10px;color:#8497a4;line-height:1.72}
#a1WorkflowEmbed .stage.active{border-color:rgba(78,190,255,.44);background:linear-gradient(180deg,rgba(21,116,189,.18),rgba(3,11,18,.96));box-shadow:0 0 32px rgba(42,146,220,.12)}
#a1WorkflowEmbed .stage.done{border-color:rgba(83,221,167,.18)}
#a1WorkflowEmbed .stage.done b{color:var(--green)}
#a1WorkflowEmbed .stage.active b{color:#88dfff}
#a1WorkflowEmbed .console{border:1px solid var(--line);background:#01060c;min-height:365px;padding:23px 24px;font:11px/1.65 ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono",monospace;color:#758896;overflow:auto;scroll-behavior:smooth}
#a1WorkflowEmbed .console-line{opacity:0;transform:translateY(3px);animation:a1LineIn .25s ease forwards;white-space:normal;overflow-wrap:anywhere;margin:0 0 4px}
#a1WorkflowEmbed .console-line strong{color:#b7d7e9;font-weight:650}
#a1WorkflowEmbed .console-line .ai{color:#90cfff}
#a1WorkflowEmbed .console-line .customer{color:#d7e3ea}
#a1WorkflowEmbed .console-line .ok{color:var(--green)}
#a1WorkflowEmbed .console-line .urgent{color:#ffb7aa}
#a1WorkflowEmbed .console-line .crm{color:#82dcb6}
#a1WorkflowEmbed .console-line .action{color:#8ec8ff}
@keyframes a1LineIn{to{opacity:1;transform:none}}
#a1WorkflowEmbed .ready{color:#71818e}
#a1WorkflowEmbed .run-footer{display:flex;align-items:flex-end;justify-content:space-between;gap:26px;margin-top:20px}
#a1WorkflowEmbed .disclaimer{margin:0;color:#536a78;font-size:9px;line-height:1.55;max-width:690px}
#a1WorkflowEmbed .run-btn{border:0;background:#69dbff;color:#00111c;min-width:190px;min-height:52px;padding:0 23px;cursor:pointer;text-transform:uppercase;letter-spacing:.13em;font-weight:850;font-size:9px;box-shadow:0 0 30px rgba(66,195,255,.19)}
#a1WorkflowEmbed .run-btn:hover{filter:brightness(1.05)}
#a1WorkflowEmbed .run-btn:disabled{opacity:.72;cursor:wait}
#a1WorkflowEmbed .run-btn.done{min-width:215px}
#a1WorkflowEmbed .stage-hint{font-size:8px;color:#4f6876;margin:9px 0 0;text-align:right}
@media(max-width:980px){
 #a1WorkflowEmbed .proof-body{grid-template-columns:1fr}
 #a1WorkflowEmbed .config{border-right:0;border-bottom:1px solid var(--line)}
 #a1WorkflowEmbed .run-area,#a1WorkflowEmbed .config{padding:22px}
 #a1WorkflowEmbed .architecture{grid-template-columns:repeat(5,minmax(135px,1fr));overflow-x:auto;padding-bottom:8px;-webkit-overflow-scrolling:touch}
 #a1WorkflowEmbed .stage{min-height:105px}
 #a1WorkflowEmbed .console{min-height:330px}
 #a1WorkflowEmbed .run-footer{align-items:stretch;flex-direction:column}
 #a1WorkflowEmbed .run-btn{width:100%}
}
@media(max-width:600px){
 #a1WorkflowEmbed .workflow-section-head{padding:58px 18px 0;margin-bottom:34px}
 #a1WorkflowEmbed .workflow-eyebrow{font-size:9px}
 #a1WorkflowEmbed .workflow-section-head h2{font-size:37px;margin:14px 0 16px}
 #a1WorkflowEmbed .workflow-section-head p{font-size:12px;line-height:1.7}
  #a1WorkflowEmbed .proof-shell{border-radius:14px}
 #a1WorkflowEmbed .niche-select{padding:17px 18px 13px}
 #a1WorkflowEmbed .niche-select-head{align-items:flex-start;flex-direction:column;gap:4px;margin-bottom:10px}
 #a1WorkflowEmbed .niche-select-head span{font-size:8px}
 #a1WorkflowEmbed .niche-track{flex-wrap:nowrap;overflow-x:auto;scrollbar-width:thin;scrollbar-color:#18384a transparent;-webkit-overflow-scrolling:touch}
 #a1WorkflowEmbed .niche-btn{min-height:44px;padding:10px 12px;font-size:9px}
    #a1WorkflowEmbed .config,#a1WorkflowEmbed .run-area{padding:18px}
 #a1WorkflowEmbed .source-grid{grid-template-columns:1fr}
 #a1WorkflowEmbed .source-btn:last-child{grid-column:auto}
 #a1WorkflowEmbed .source-btn,#a1WorkflowEmbed .flow-btn{min-height:48px}
 #a1WorkflowEmbed .flow-grid{grid-template-columns:1fr 1fr}
 #a1WorkflowEmbed .architecture{grid-template-columns:repeat(5,150px);margin-inline:0}
 #a1WorkflowEmbed .console{padding:18px 16px;font-size:10px;min-height:350px}
 #a1WorkflowEmbed .stage-hint{text-align:left}
 #a1WorkflowEmbed .demo-summary p{font-size:10px}
}
@media(max-width:380px){
 #a1WorkflowEmbed .workflow-section-head{padding-top:48px;margin-bottom:30px}
 #a1WorkflowEmbed .workflow-section-head h2{font-size:33px}
 #a1WorkflowEmbed .flow-grid{grid-template-columns:1fr}
  #a1WorkflowEmbed .config,#a1WorkflowEmbed .run-area{padding:14px}
}
@media(prefers-reduced-motion:reduce){#a1WorkflowEmbed *{animation:none!important;transition:none!important;scroll-behavior:auto!important}#a1WorkflowEmbed .console-line{opacity:1;transform:none}}
</style>

<style id="a1WebsiteThemeAlignment">
/* Visual-only alignment pass to match the approved A1 Legacy website theme.
   Workflow markup, controls, data and animation logic remain unchanged. */
#a1WorkflowEmbed{
  --bg:#040b12;
  --panel:#07111d;
  --panel2:#050c14;
  --panel3:#08131f;
  --line:rgba(72,108,148,.22);
  --line2:rgba(52,122,255,.55);
  --text:#f5f8fb;
  --muted:#7d8f9f;
  --muted2:#91a2b0;
  --blue:#7eb7ff;
  --blue2:#287cff;
  --green:#58d0a5;
  --danger:#ff9f92;
  --radius:8px;
  box-sizing:border-box;
  position:relative;
  isolation:isolate;
  overflow:hidden;
  padding:0 24px 104px;
  background:
    linear-gradient(90deg, transparent 0, transparent calc(25% - .5px), rgba(80,120,165,.055) 25%, transparent calc(25% + .5px), transparent calc(50% - .5px), rgba(80,120,165,.045) 50%, transparent calc(50% + .5px), transparent calc(75% - .5px), rgba(80,120,165,.055) 75%, transparent calc(75% + .5px)),
    linear-gradient(180deg, rgba(13,34,58,.12), transparent 260px),
    #040b12;
}
#a1WorkflowEmbed::before,
#a1WorkflowEmbed::after{
  content:"";
  position:absolute;
  left:0;right:0;
  height:1px;
  pointer-events:none;
  background:linear-gradient(90deg,transparent,rgba(69,109,152,.22) 14%,rgba(69,109,152,.22) 86%,transparent);
  z-index:0;
}
#a1WorkflowEmbed::before{top:0}
#a1WorkflowEmbed::after{bottom:0}
#a1WorkflowEmbed > *{position:relative;z-index:1}

#a1WorkflowEmbed .workflow-section-head{
  width:min(1200px,100%);
  max-width:none;
  margin:0 auto 52px;
  padding:96px 0 0;
  text-align:left;
}
#a1WorkflowEmbed .workflow-eyebrow{
  display:flex;
  width:max-content;
  align-items:center;
  gap:10px;
  color:#7d9bb3;
  font-size:9px;
  font-weight:760;
  letter-spacing:.19em;
}
#a1WorkflowEmbed .workflow-eyebrow::before{
  width:20px;
  background:#2d7dff;
  opacity:.9;
}
#a1WorkflowEmbed .workflow-section-head h2{
  max-width:none;
  margin:14px 0 16px;
  color:#f6f9fc;
  font-size:clamp(42px,4vw,56px);
  line-height:.98;
  letter-spacing:-.055em;
  font-weight:470;
  white-space:nowrap;
}
#a1WorkflowEmbed .workflow-section-head p{
  max-width:720px;
  margin:0;
  color:#8193a3;
  font-size:13px;
  line-height:1.78;
}

#a1WorkflowEmbed .proof-shell{
  width:min(1200px,100%);
  border:1px solid rgba(57,92,129,.28);
  border-radius:var(--radius);
  background:linear-gradient(180deg,#07111d 0%,#050b12 100%);
  box-shadow:none;
}
#a1WorkflowEmbed .niche-select{
  padding:22px 28px 18px;
  background:#050c14;
  border-bottom-color:rgba(57,92,129,.24);
}
#a1WorkflowEmbed .niche-select-head b,
#a1WorkflowEmbed .control-label,
#a1WorkflowEmbed .demo-summary small,
#a1WorkflowEmbed .selected-setup span{
  color:#6f8aa1;
}
#a1WorkflowEmbed .niche-select-head span,
#a1WorkflowEmbed .stage-hint,
#a1WorkflowEmbed .disclaimer{
  color:#536b7d;
}
#a1WorkflowEmbed .niche-btn,
#a1WorkflowEmbed .source-btn,
#a1WorkflowEmbed .flow-btn,
#a1WorkflowEmbed .stage{
  background:#07101a;
  border-color:rgba(62,99,138,.24);
  color:#8294a3;
}
#a1WorkflowEmbed .niche-btn:hover,
#a1WorkflowEmbed .source-btn:hover,
#a1WorkflowEmbed .flow-btn:hover,
#a1WorkflowEmbed .stage:hover{
  border-color:rgba(54,122,255,.42);
  background:#081522;
}
#a1WorkflowEmbed .niche-btn.active,
#a1WorkflowEmbed .source-btn.active,
#a1WorkflowEmbed .flow-btn.active{
  border-color:rgba(52,122,255,.62);
  background:linear-gradient(180deg,rgba(28,78,153,.28),rgba(9,24,41,.94));
  color:#eef7ff;
  box-shadow:inset 0 0 0 1px rgba(87,154,255,.05);
}
#a1WorkflowEmbed .source-btn.active .dot{
  background:#5f9eff;
  border-color:#5f9eff;
  box-shadow:0 0 12px rgba(51,120,255,.38);
}
#a1WorkflowEmbed .selected-setup{
  border-color:rgba(62,99,138,.22);
  background:#050c14;
}
#a1WorkflowEmbed .stage.active{
  border-color:rgba(52,122,255,.58);
  background:linear-gradient(180deg,rgba(30,82,162,.26),rgba(7,16,26,.98));
  box-shadow:0 0 28px rgba(31,92,201,.10);
}
#a1WorkflowEmbed .stage.active b{color:#78b4ff}
#a1WorkflowEmbed .stage.done{border-color:rgba(73,185,144,.24)}
#a1WorkflowEmbed .stage.done b{color:#64d5aa}
#a1WorkflowEmbed .console{
  background:#03080e;
  border-color:rgba(57,92,129,.30);
  color:#7e91a1;
  height:clamp(340px,48vh,420px);
  min-height:0;
}
#a1WorkflowEmbed .console-line strong{color:#c8d9e6}
#a1WorkflowEmbed .console-line .ai{color:#79b8ff}
#a1WorkflowEmbed .console-line .customer{color:#d6e0e8}
#a1WorkflowEmbed .console-line .crm{color:#67d0ac}
#a1WorkflowEmbed .console-line .action{color:#83baff}
#a1WorkflowEmbed .run-btn{
  background:linear-gradient(180deg,#91ccff,#74b6f6);
  color:#03111f;
  border:1px solid rgba(184,225,255,.42);
  box-shadow:0 0 28px rgba(48,125,255,.17);
}

@media(max-width:980px){
  #a1WorkflowEmbed{padding-inline:20px;padding-bottom:82px}
  #a1WorkflowEmbed .workflow-section-head{padding-top:78px;margin-bottom:42px}
  #a1WorkflowEmbed .workflow-section-head h2{white-space:normal}
  #a1WorkflowEmbed .console{height:380px;min-height:0}
}
@media(max-width:600px){
  #a1WorkflowEmbed{
    padding:0 14px 68px;
    background:
      linear-gradient(90deg, transparent 0, transparent calc(50% - .5px), rgba(80,120,165,.045) 50%, transparent calc(50% + .5px)),
      #040b12;
  }
  #a1WorkflowEmbed .workflow-section-head{
    width:100%;
    padding:62px 4px 0;
    margin-bottom:34px;
    text-align:left;
  }
  #a1WorkflowEmbed .workflow-section-head h2{
    max-width:100%;
    font-size:clamp(36px,10.8vw,46px);
    line-height:1.01;
    margin:12px 0 14px;
  }
  #a1WorkflowEmbed .workflow-section-head p{
    max-width:100%;
    font-size:12px;
    line-height:1.72;
  }
  #a1WorkflowEmbed .proof-shell{border-radius:6px}
  #a1WorkflowEmbed .console{height:340px;min-height:0}
}
</style>

<div class="workflow-section-head">
  <span class="workflow-eyebrow">WORKFLOW PROOF</span>
  <h2>See the customer journey move.</h2>
  <p>This interactive walkthrough shows the logic A1 Legacy implements: entry, qualification, next action, CRM update and human handoff. It is intentionally transparent about where automation ends and the team takes over.</p>
</div>
<section class="proof-shell" id="workflowProof">
  <div class="niche-select">
    <div class="niche-select-head"><b>Select your business niche</b><span>Choose a niche to load its customer journey</span></div>
    <div class="niche-track" data-niches role="group" aria-label="Select business niche"></div>
  </div>

  <div class="proof-body">
    <aside class="config">
      <p class="control-label">1 — Select lead source</p>
      <div class="source-grid" role="group" aria-label="Select lead source">
        <button type="button" class="source-btn" data-source="chat"><span class="dot"></span>Website chat widget</button>
        <button type="button" class="source-btn" data-source="form"><span class="dot"></span>Website form</button>
        <button type="button" class="source-btn" data-source="sms"><span class="dot"></span>SMS</button>
        <button type="button" class="source-btn" data-source="email"><span class="dot"></span>Email</button>
        <button type="button" class="source-btn active" data-source="call"><span class="dot"></span>Phone call</button>
      </div>

      <p class="control-label">2 — Select journey</p>
      <div class="flow-grid" role="group" aria-label="Select journey type">
        <button type="button" class="flow-btn active" data-flow="normal">Normal flow<small>Routine booking journey</small></button>
        <button type="button" class="flow-btn" data-flow="emergency">Emergency flow<small>Immediate escalation path</small></button>
      </div>

      <hr class="divider">
      <div class="demo-summary"><small>What this demonstrates</small><p data-summary></p></div>
      <div class="selected-setup"><span>Selected demo</span><strong data-selected></strong></div>
    </aside>

    <div class="run-area">
      <div class="architecture" data-stages></div>
      <div class="console" data-console aria-live="polite"></div>
      <p class="stage-hint">You can also click ENTRY, AI, ACTION, CRM or TEAM to preview the workflow up to that stage.</p>
      <div class="run-footer">
        <p class="disclaimer">Production deployment connects this logic to the approved communication channel, CRM, calendar, assignment and notification systems. Exact actions depend on the client's configured systems, access and supported integrations.</p>
        <button type="button" class="run-btn" data-run>Check AI Functionality</button>
      </div>
    </div>
  </div>
</section>
<script>
(()=>{
  const outer=document.getElementById('a1WorkflowEmbed');
  const root=outer?.querySelector('#workflowProof');
  if(!root || root.dataset.ready==='1') return;
  root.dataset.ready='1';
  const niches=[{"id":"plumbing","category":"Home Services","label":"Plumbing","team":"plumber","service":"faucet replacement","customer":"I need someone to replace a faucet in my kitchen.","urgency_q":"Is the faucet actively broken and flooding, or is this a regular replacement?","normal_reply":"It is not flooding. I just need the faucet replaced.","fields":"customer name · mobile number · email if required · property address · service = faucet replacement","time_q":"What day and time would you prefer for the replacement?","time_reply":"Wednesday morning around 10:00 works for me.","slot":"Wednesday, 23 September at 10:00 AM","confirm":"Your appointment is booked. Our plumber will be at your property on Wednesday, 23 September at 10:00 AM.","stage":"Booked","task":"service task","completion":"faucet replacement","follow":"Was your faucet replacement completed successfully? We’d appreciate your feedback on the service.","emergency":"The main line is broken and water is flooding the property right now.","emergency_rule":"active flooding / immediate property-damage risk","critical":"customer name · callback number · property address · active flooding · main-line break · brief issue description","emergency_team":"human/on-call plumbing team"},{"id":"hvac","category":"Home Services","label":"HVAC / Heating & Cooling","team":"HVAC technician","service":"air-conditioning repair","customer":"My air conditioner is running but it is not cooling the house.","urgency_q":"Is this a routine repair, or is there an urgent condition such as no heating/cooling where your business emergency rules apply?","normal_reply":"It is a normal repair. We can manage until the appointment.","fields":"customer name · phone/email · service address · system type · symptom = not cooling · preferred visit time","time_q":"What day and time would you prefer for the technician visit?","time_reply":"Thursday afternoon around 2:00 works.","slot":"Thursday, 24 September at 2:00 PM","confirm":"Your HVAC service appointment is booked for Thursday, 24 September at 2:00 PM.","stage":"Booked","task":"HVAC service task","completion":"HVAC service visit","follow":"Was the HVAC issue resolved successfully? We’d appreciate your feedback on the technician and service.","emergency":"Our heating has completely failed and there is a vulnerable elderly person in the property during freezing weather.","emergency_rule":"configured no-heat / vulnerable-occupant emergency condition","critical":"customer name · callback number · property address · system status · vulnerable occupant context · current conditions","emergency_team":"human/on-call HVAC team"},{"id":"electrical","category":"Home Services","label":"Electrical","team":"electrician","service":"socket / circuit repair","customer":"Several sockets in one room have stopped working.","urgency_q":"Are there any sparks, smoke, burning smell or another immediate electrical safety issue, or is this a routine fault?","normal_reply":"No sparks or burning smell. It is just the sockets not working.","fields":"customer name · phone/email · property address · affected area · fault description · preferred visit time","time_q":"What day and time would you prefer for the electrician?","time_reply":"Friday at 11:00 AM works for me.","slot":"Friday, 25 September at 11:00 AM","confirm":"Your electrician is booked for Friday, 25 September at 11:00 AM.","stage":"Booked","task":"electrical service task","completion":"electrical repair","follow":"Was the electrical issue resolved successfully? We’d appreciate your feedback on the service.","emergency":"There are sparks and a burning smell coming from the electrical panel.","emergency_rule":"sparking / burning smell / immediate electrical safety risk","critical":"customer name · callback number · property address · electrical panel issue · sparks/burning smell · immediate context","emergency_team":"human/on-call electrical team"},{"id":"roofing","category":"Home Services","label":"Roofing","team":"roofer","service":"roof leak inspection","customer":"I have a small roof leak after the rain and need someone to inspect it.","urgency_q":"Is water actively entering the property or is there storm damage creating an immediate risk, or is this a routine inspection?","normal_reply":"It is a small leak and not actively flooding.","fields":"customer name · phone/email · property address · roof issue · when it started · access notes · preferred inspection time","time_q":"What day and time would you prefer for the roof inspection?","time_reply":"Saturday morning at 9:30 works.","slot":"Saturday, 26 September at 9:30 AM","confirm":"Your roof inspection is booked for Saturday, 26 September at 9:30 AM.","stage":"Inspection Booked","task":"roof inspection task","completion":"roof inspection / repair","follow":"Was the roofing work completed successfully? We’d appreciate your feedback on the service.","emergency":"A section of the roof has been damaged in the storm and water is actively coming into the property.","emergency_rule":"active water ingress / storm damage / immediate property risk","critical":"customer name · callback number · property address · active water ingress · storm damage summary · safe access notes if known","emergency_team":"human/on-call roofing team"},{"id":"auto-service","category":"Automotive","label":"Workshop / Service Centre","team":"service adviser / technician","service":"vehicle service appointment","customer":"My car is due for a service, and I have also noticed a noise from the front brakes.","urgency_q":"Before I book it in, is the vehicle still safe and driveable, or is it broken down, not starting, or showing an immediate safety issue?","normal_reply":"It is still driveable. I would like the brakes checked during the service.","fields":"customer name · phone/email · vehicle make/model · registration if required · service need · symptom · preferred date/time","time_q":"What day and time would you prefer to bring the vehicle in?","time_reply":"Thursday at 8:30 AM works.","slot":"Thursday, 24 September at 8:30 AM","confirm":"Your vehicle is booked into the workshop for Thursday, 24 September at 8:30 AM.","stage":"Workshop Booked","task":"workshop job / service task","completion":"vehicle service","follow":"Was the vehicle service completed to your satisfaction? We’d appreciate your feedback on the workshop and technician.","emergency":"My car has broken down on the road and will not start.","emergency_rule":"vehicle stranded / non-start / configured roadside emergency","critical":"customer name · callback number · vehicle make/model · current location · stranded status · brief symptom","emergency_team":"human service / roadside response team"},{"id":"auto-sales","category":"Automotive","label":"Vehicle Dealership / Sales","team":"sales adviser","service":"vehicle viewing / sales consultation","customer":"I am interested in the 2025 SUV you have listed and want to arrange a viewing.","urgency_q":"Is this a normal sales enquiry, or is there an urgent existing-customer safety/service issue that needs a human immediately?","normal_reply":"It is a normal sales enquiry. I want to view the vehicle.","fields":"customer name · phone/email · vehicle of interest · budget/finance preference if volunteered · trade-in interest · preferred viewing time","time_q":"What day and time would you prefer to visit the dealership?","time_reply":"Saturday at 1:00 PM works.","slot":"Saturday, 26 September at 1:00 PM","confirm":"Your vehicle viewing is booked for Saturday, 26 September at 1:00 PM with a sales adviser.","stage":"Viewing Booked","task":"sales follow-up task","completion":"vehicle viewing / sales consultation","follow":"How was your dealership visit? Would you like help with the next step or vehicle options?","emergency":"I recently purchased a vehicle from you and a serious brake warning has appeared. I do not feel safe driving it.","emergency_rule":"existing-customer vehicle safety concern requiring immediate human review","critical":"customer name · callback number · vehicle details · purchase context · warning/safety concern · current location if relevant","emergency_team":"human service / customer-care team"},{"id":"realestate-buyer","category":"Real Estate","label":"Buyer / Property Enquiry","team":"property agent","service":"property viewing","customer":"I am interested in the three-bedroom property on Oak Street and would like more information.","urgency_q":"Are you looking to arrange a standard viewing, or is there a same-day offer deadline or viewing window I should escalate to an agent?","normal_reply":"There is no deadline today. I would like to arrange a viewing.","fields":"buyer name · phone/email · property/listing · budget range · preferred area if relevant · buying timeframe · viewing preference","time_q":"What day and time would you prefer for the viewing?","time_reply":"Friday at 4:30 PM works.","slot":"Friday, 25 September at 4:30 PM","confirm":"Your property viewing is booked for Friday, 25 September at 4:30 PM with the assigned agent.","stage":"Viewing Booked","task":"buyer follow-up / viewing task","completion":"property viewing","follow":"How did the viewing go? Would you like to make an offer, ask a question or see similar properties?","emergency":"The seller is closing offers today and I need to speak with an agent before the deadline.","emergency_rule":"same-day offer deadline / configured high-priority sales event","critical":"buyer name · callback number · property/listing · offer-deadline context · current intent / offer status","emergency_team":"human property / sales agent"},{"id":"realestate-seller","category":"Real Estate","label":"Seller / Valuation Enquiry","team":"listing / valuation agent","service":"property valuation appointment","customer":"I am thinking about selling my property and would like a valuation.","urgency_q":"Is this a standard valuation request, or is there a time-sensitive sale/chain issue that needs an agent today?","normal_reply":"It is a normal valuation request.","fields":"seller name · phone/email · property address · property type · selling timeframe · reason for valuation if volunteered · preferred appointment time","time_q":"What day and time would you prefer for the valuation appointment?","time_reply":"Tuesday at 3:00 PM works.","slot":"Tuesday, 29 September at 3:00 PM","confirm":"Your valuation appointment is booked for Tuesday, 29 September at 3:00 PM.","stage":"Valuation Booked","task":"seller valuation task","completion":"valuation appointment","follow":"Was the valuation helpful? Would you like to discuss listing strategy and next steps with the agent?","emergency":"My buyer has given us a deadline today and our sale chain may collapse unless I speak to the agent immediately.","emergency_rule":"same-day sale-chain / completion issue requiring immediate agent review","critical":"seller name · callback number · property address · deadline/chain issue · current transaction status","emergency_team":"human listing / transaction agent"},{"id":"property-management","category":"Real Estate","label":"Rental / Property Management","team":"property manager / maintenance coordinator","service":"maintenance request","customer":"The kitchen tap is leaking and I need maintenance to look at it.","urgency_q":"Is this a routine maintenance issue, or is there active flooding, loss of essential service or another configured property emergency?","normal_reply":"It is a slow leak. There is no flooding.","fields":"tenant/customer name · phone/email · property address/unit · maintenance issue · access notes · preferred visit time","time_q":"What day and time works for maintenance access?","time_reply":"Wednesday after 1:00 PM works.","slot":"Wednesday, 23 September at 1:30 PM","confirm":"Your maintenance visit is booked for Wednesday, 23 September at 1:30 PM.","stage":"Maintenance Booked","task":"maintenance task / work order","completion":"maintenance visit","follow":"Was the maintenance issue resolved? Please rate the service so the property team can track the outcome.","emergency":"A pipe has burst in the apartment and water is flooding the kitchen.","emergency_rule":"active flooding / essential-service / configured property emergency","critical":"tenant name · callback number · property/unit · emergency type · active damage status · access information","emergency_team":"human property-management / emergency maintenance team"},{"id":"insurance-new","category":"Insurance","label":"New Quote / Policy","team":"insurance adviser / producer","service":"insurance consultation","customer":"I need a business insurance quote for my company.","urgency_q":"When do you need the cover to start? Is there any same-day coverage deadline that requires an adviser immediately?","normal_reply":"There is no same-day deadline. I need the cover to start next month.","fields":"prospect name · phone/email · business/policy type · key qualification details approved by the brokerage · desired start date · preferred contact time","time_q":"When would you like an adviser to call or meet to complete the quote?","time_reply":"Tomorrow at 11:30 AM works.","slot":"Wednesday, 23 September at 11:30 AM","confirm":"Your insurance consultation is booked for Wednesday, 23 September at 11:30 AM.","stage":"Consultation Booked","task":"quote / producer follow-up task","completion":"insurance consultation / quote review","follow":"Did you receive everything you needed from the insurance consultation? Would you like help with the next step?","emergency":"My current cover ends today and I need an adviser to review whether new coverage can be arranged urgently.","emergency_rule":"same-day coverage deadline requiring licensed human review","critical":"prospect name · callback number · policy/business type · coverage deadline · current cover context","emergency_team":"licensed insurance adviser / producer"},{"id":"insurance-renewal","category":"Insurance","label":"Renewal / Existing Client","team":"account manager / insurance adviser","service":"renewal review","customer":"My business policy is coming up for renewal and I want to review the cover.","urgency_q":"Is this a routine renewal review, or does the policy expire today / require immediate adviser attention?","normal_reply":"It renews next month, so it is a normal review.","fields":"client name · phone/email · policy/account reference if available · renewal date · requested changes/questions · preferred review time","time_q":"When would you like your account manager to review the renewal with you?","time_reply":"Friday at 10:30 AM works.","slot":"Friday, 25 September at 10:30 AM","confirm":"Your renewal review is booked for Friday, 25 September at 10:30 AM.","stage":"Renewal Review Booked","task":"renewal review task","completion":"renewal review","follow":"Was your renewal review completed? Do you need any further policy administration support?","emergency":"The policy expires today and I need to speak with someone before close of business.","emergency_rule":"same-day policy expiry / urgent account-service deadline","critical":"client name · callback number · policy reference if available · expiry date · urgent request summary","emergency_team":"human account manager / licensed adviser"},{"id":"consulting","category":"Professional Services","label":"Consulting / Agency / B2B","team":"consultant / sales lead","service":"discovery consultation","customer":"We need help improving our sales process and I would like to speak with someone about the project.","urgency_q":"Is there a fixed deadline or decision happening today, or can I arrange this as a standard discovery consultation?","normal_reply":"There is no deadline today. We are planning the project for next month.","fields":"contact name · phone/email · company · service need · current problem · budget/timeline if volunteered · preferred meeting time","time_q":"What day and time would suit you for a discovery call?","time_reply":"Thursday at 3:30 PM works.","slot":"Thursday, 24 September at 3:30 PM","confirm":"Your discovery call is booked for Thursday, 24 September at 3:30 PM.","stage":"Discovery Booked","task":"consultation / sales follow-up task","completion":"discovery consultation","follow":"Was the discovery call useful? Would you like the team to prepare the next recommended step or proposal?","emergency":"We have a board deadline today and need a senior consultant to confirm whether you can support the project immediately.","emergency_rule":"same-day strategic deadline / configured high-value escalation","critical":"contact name · callback number · company · project need · deadline · decision context","emergency_team":"senior consultant / sales lead"},{"id":"accounting","category":"Professional Services","label":"Accounting / CFO Services","team":"accountant / finance adviser","service":"finance consultation","customer":"We need help with monthly management accounts and cash-flow reporting.","urgency_q":"Is this a standard finance enquiry, or is there a filing/payment deadline today that needs immediate human review?","normal_reply":"It is a normal enquiry. We want to improve reporting next month.","fields":"contact name · phone/email · company · finance service needed · current accounting setup · business size/context · preferred consultation time","time_q":"When would you like to speak with the finance team?","time_reply":"Wednesday at 2:00 PM works.","slot":"Wednesday, 23 September at 2:00 PM","confirm":"Your finance consultation is booked for Wednesday, 23 September at 2:00 PM.","stage":"Consultation Booked","task":"finance consultation task","completion":"finance consultation","follow":"Was the finance consultation useful? Would you like the team to outline the next implementation step?","emergency":"We have a tax/payment filing deadline today and need an accountant to review the situation urgently.","emergency_rule":"same-day filing/payment deadline requiring qualified human review","critical":"contact name · callback number · company · deadline type/date · current issue summary","emergency_team":"qualified accountant / finance lead"},{"id":"legal","category":"Professional Services","label":"Legal Services — Admin Intake","team":"lawyer / legal intake team","service":"legal consultation","customer":"I need to speak with someone about a contract dispute.","urgency_q":"Is this a standard consultation request, or is there a court/deadline/custody or other urgent matter that requires immediate lawyer review?","normal_reply":"It is a standard consultation. There is no deadline today.","fields":"contact name · phone/email · matter type · opposing party/conflict-check information where approved · important dates · preferred consultation time","time_q":"What day and time would you prefer for an initial consultation?","time_reply":"Friday at 12:00 PM works.","slot":"Friday, 25 September at 12:00 PM","confirm":"Your legal consultation is booked for Friday, 25 September at 12:00 PM.","stage":"Consultation Booked","task":"legal intake / consultation task","completion":"initial legal consultation","follow":"Was your consultation completed? If appropriate, the team can contact you regarding the agreed next administrative step.","emergency":"I have a court deadline today and need a lawyer to review the matter urgently.","emergency_rule":"same-day legal deadline / urgent matter requiring lawyer review","critical":"contact name · callback number · matter type · deadline/date · essential administrative context only","emergency_team":"lawyer / urgent legal intake team"},{"id":"clinic","category":"Healthcare","label":"Clinic / Medical Practice","team":"clinical / front-desk team","service":"appointment request","customer":"I have been having recurring headaches and would like to book an appointment with the clinic.","urgency_q":"Before I arrange that, are you experiencing any emergency symptoms the clinic has defined for immediate escalation, or is this suitable for a routine appointment?","normal_reply":"I am not experiencing any emergency symptoms. A routine appointment is fine.","fields":"patient name · contact details · approved administrative reason for visit · preferred practitioner/location if relevant · preferred appointment time","time_q":"What day and time would you prefer for the appointment?","time_reply":"Thursday at 10:00 AM works.","slot":"Thursday, 24 September at 10:00 AM","confirm":"Your appointment request is booked for Thursday, 24 September at 10:00 AM, subject to the clinic’s configured scheduling rules.","stage":"Appointment Booked","task":"appointment / front-desk task","completion":"clinic appointment","follow":"Was your appointment completed? The system can send approved administrative follow-up or satisfaction feedback without giving medical advice.","emergency":"I am having severe chest pain right now.","emergency_rule":"clinic-defined emergency symptom requiring immediate emergency-services / clinical escalation","critical":"patient name · callback number if safely available · location if part of approved process · emergency statement · no diagnosis","emergency_team":"clinical team / emergency-services path defined by the clinic"},{"id":"dental","category":"Healthcare","label":"Dental / Elective Treatment","team":"dental coordinator / clinician","service":"dental consultation","customer":"I am interested in dental implants and want to arrange a consultation.","urgency_q":"Is this a routine consultation, or is there severe bleeding, breathing difficulty, major swelling or another emergency condition defined by the clinic?","normal_reply":"It is a normal implant consultation.","fields":"patient name · phone/email · treatment interest · relevant approved administrative details · preferred consultation time · location/language if required","time_q":"What day and time would you prefer for the consultation?","time_reply":"Monday at 1:30 PM works.","slot":"Monday, 28 September at 1:30 PM","confirm":"Your dental consultation is booked for Monday, 28 September at 1:30 PM.","stage":"Consultation Booked","task":"patient-coordination task","completion":"dental consultation","follow":"Was your consultation completed? The coordinator can follow up on approved next steps and request service feedback.","emergency":"I have severe swelling and difficulty breathing after a dental problem.","emergency_rule":"clinic-defined medical/dental emergency requiring immediate emergency-services / clinician escalation","critical":"patient name · callback number if safely available · emergency statement · current location if approved · no diagnosis","emergency_team":"clinical team / emergency-services path defined by the clinic"},{"id":"financial-advice","category":"Financial Services","label":"Financial Adviser / Wealth","team":"financial adviser / client-service team","service":"financial planning consultation","customer":"I would like to speak with an adviser about retirement planning.","urgency_q":"Is this a planning enquiry, or are you contacting us about an urgent account or security issue that needs a human immediately?","normal_reply":"It is a planning enquiry. There is no urgent account or security issue.","fields":"prospect name · phone/email · broad service interest · preferred meeting time · only approved non-sensitive qualification data","time_q":"When would you like to speak with an adviser?","time_reply":"Thursday at 11:00 AM works.","slot":"Thursday, 24 September at 11:00 AM","confirm":"Your adviser consultation is booked for Thursday, 24 September at 11:00 AM.","stage":"Consultation Booked","task":"adviser consultation task","completion":"financial planning consultation","follow":"Was your consultation completed? The team can follow up on the agreed administrative next step without the AI giving regulated advice.","emergency":"I think there may be an unauthorized transaction or security issue on my account and need someone now.","emergency_rule":"account/security concern requiring immediate human review","critical":"client name · callback number · high-level security concern · account reference only if approved · no advice or sensitive disclosure","emergency_team":"human adviser / client-security team"},{"id":"mortgage","category":"Financial Services","label":"Mortgage / Finance Broker","team":"mortgage / finance broker","service":"mortgage consultation","customer":"I am buying a property and want to understand my mortgage options.","urgency_q":"Is this a standard mortgage enquiry, or is there a completion/offer deadline today that needs a broker immediately?","normal_reply":"It is a standard enquiry. We are at the early stage.","fields":"prospect name · phone/email · purchase/refinance intent · approximate property/budget context · timeframe · preferred consultation time · only approved qualification data","time_q":"When would you like to speak with a broker?","time_reply":"Wednesday at 4:00 PM works.","slot":"Wednesday, 23 September at 4:00 PM","confirm":"Your mortgage consultation is booked for Wednesday, 23 September at 4:00 PM.","stage":"Consultation Booked","task":"broker consultation task","completion":"mortgage consultation","follow":"Was the broker consultation completed? The team can follow up on the agreed document or application next step.","emergency":"Our property completion is at risk today and I need to speak with the broker urgently.","emergency_rule":"same-day completion / mortgage deadline requiring broker review","critical":"prospect name · callback number · property/transaction reference · deadline · current high-level issue","emergency_team":"human mortgage / finance broker"},{"id":"recruitment-candidate","category":"Recruitment","label":"Candidate / Applicant","team":"recruiter","service":"candidate screening / interview","customer":"I am interested in the operations manager vacancy and would like to apply.","urgency_q":"Are you applying for the role, or do you have an interview or access issue happening today that needs a recruiter immediately?","normal_reply":"I am applying for the role. I do not have an interview issue today.","fields":"candidate name · phone/email · role of interest · location/work authorization questions where approved · availability · CV/application status · preferred screening time","time_q":"When would you be available for an initial screening call?","time_reply":"Thursday at 9:00 AM works.","slot":"Thursday, 24 September at 9:00 AM","confirm":"Your initial screening call is booked for Thursday, 24 September at 9:00 AM.","stage":"Screening Booked","task":"candidate screening task","completion":"candidate screening","follow":"How did the screening go? The recruiter can follow up with the next approved stage or status update.","emergency":"My interview starts in 30 minutes and the access link is not working.","emergency_rule":"imminent interview / access issue requiring recruiter support","critical":"candidate name · callback number · role · interview time · access/problem summary","emergency_team":"human recruiter / interview coordinator"},{"id":"recruitment-employer","category":"Recruitment","label":"Employer / Hiring Client","team":"account manager / recruiter","service":"hiring consultation","customer":"We need to hire three warehouse supervisors and want recruitment support.","urgency_q":"Is this a standard hiring requirement, or is there a critical shift/start-date gap that needs immediate recruiter attention?","normal_reply":"It is a normal hiring requirement for next month.","fields":"contact name · phone/email · company · roles/headcount · location · target start date · hiring challenge · preferred consultation time","time_q":"When would you like to speak with the recruitment team?","time_reply":"Tuesday at 11:00 AM works.","slot":"Tuesday, 29 September at 11:00 AM","confirm":"Your hiring consultation is booked for Tuesday, 29 September at 11:00 AM.","stage":"Hiring Call Booked","task":"employer account / recruitment task","completion":"hiring consultation","follow":"Was the hiring consultation useful? The account manager can follow up with the agreed role brief or next step.","emergency":"We have a critical shift starting tomorrow and are missing essential staff. I need to speak to a recruiter now.","emergency_rule":"immediate staffing gap / configured high-priority employer request","critical":"contact name · callback number · company · role/headcount · start time/deadline · location","emergency_team":"senior recruiter / account manager"},{"id":"salon","category":"Local Services","label":"Salon / Spa / Beauty","team":"stylist / therapist / front desk","service":"appointment booking","customer":"I would like to book a hair colour appointment.","urgency_q":"Is this a normal appointment request, or is there a time-sensitive same-day situation that needs the front desk directly?","normal_reply":"It is a normal appointment request.","fields":"customer name · phone/email · requested service · preferred staff member if any · appointment preferences · relevant booking notes","time_q":"What day and time would you prefer for the appointment?","time_reply":"Saturday at 11:30 AM works.","slot":"Saturday, 26 September at 11:30 AM","confirm":"Your salon appointment is booked for Saturday, 26 September at 11:30 AM.","stage":"Appointment Booked","task":"service appointment task","completion":"salon / spa appointment","follow":"How was your appointment? We’d appreciate your feedback on the service and team member.","emergency":"My wedding is today and my booked stylist has cancelled. I need to know if anyone can take the appointment urgently.","emergency_rule":"same-day critical appointment / configured priority customer situation","critical":"customer name · callback number · required service · deadline/event time · location/preference","emergency_team":"human front-desk / senior stylist team"},{"id":"cleaning","category":"Local Services","label":"Cleaning / Maintenance","team":"cleaner / maintenance coordinator","service":"cleaning / maintenance booking","customer":"I need a deep clean for a three-bedroom property before new tenants move in.","urgency_q":"Is this for a planned clean, or is there an active incident such as flooding, biohazard or another priority condition that needs immediate dispatch?","normal_reply":"It is a planned clean for next week. There is no active incident.","fields":"customer name · phone/email · property address · service type · property size/context · access notes · preferred date/time","time_q":"What day and time would you prefer for the team to attend?","time_reply":"Monday at 9:00 AM works.","slot":"Monday, 28 September at 9:00 AM","confirm":"Your service is booked for Monday, 28 September at 9:00 AM.","stage":"Service Booked","task":"cleaning / maintenance task","completion":"cleaning / maintenance service","follow":"Was the service completed successfully? We’d appreciate your feedback on the assigned team member.","emergency":"A property has flooded and we need urgent cleanup/maintenance support today.","emergency_rule":"active property incident / configured urgent cleanup or maintenance need","critical":"customer name · callback number · property address · incident type · active damage status · access details","emergency_team":"human dispatch / maintenance team"}];
  const nicheMap=Object.fromEntries(niches.map(n=>[n.id,n]));
  const featuredNiches=[
    ['plumbing','Home Services'],
    ['auto-service','Automotive'],
    ['realestate-buyer','Real Estate'],
    ['insurance-new','Insurance'],
    ['consulting','Professional Services'],
    ['clinic','Healthcare'],
    ['financial-advice','Financial Services'],
    ['recruitment-candidate','Recruitment'],
    ['cleaning','Local Services']
  ];
  const nicheTrack=root.querySelector('[data-niches]');
  const sourceBtns=[...root.querySelectorAll('[data-source]')];
  const flowBtns=[...root.querySelectorAll('[data-flow]')];
  const stageBox=root.querySelector('[data-stages]');
  const consoleBox=root.querySelector('[data-console]');
  const summaryBox=root.querySelector('[data-summary]');
  const selectedBox=root.querySelector('[data-selected]');
  const runBtn=root.querySelector('[data-run]');
  let nicheId='plumbing',source='call',flow='normal',running=false,runToken=0;
  const sourceMeta={call:{label:'Phone call',entry:'Phone call received'},chat:{label:'Website chat widget',entry:'Website chat started'},form:{label:'Website form',entry:'Form submission received'},sms:{label:'SMS',entry:'SMS enquiry received'},email:{label:'Email',entry:'Email enquiry received'}};
  const n=()=>nicheMap[nicheId];

  function renderNiches(){
    nicheTrack.innerHTML='';
    featuredNiches.forEach(([id,label])=>{
      const item=nicheMap[id];
      const b=document.createElement('button');b.type='button';b.className='niche-btn'+(item.id===nicheId?' active':'');b.dataset.niche=item.id;b.textContent=label;b.setAttribute('aria-pressed',item.id===nicheId?'true':'false');
      b.addEventListener('click',()=>{if(running)return;nicheId=item.id;setSelection(true);b.scrollIntoView?.({behavior:'smooth',block:'nearest',inline:'center'})});
      nicheTrack.appendChild(b);
    });
  }

  const normalStages=()=>[['ENTRY',sourceMeta[source].entry],['AI',`Need identified + urgency checked + ${n().service} details collected`],['ACTION','Availability / next step checked + appointment or consultation booked'],['CRM',`Contact + opportunity + booking + ${n().task} recorded`],['TEAM',`${cap(n().team)} assigned/notified + outcome and feedback tracked`]];
  const emergencyStages=()=>[['ENTRY',sourceMeta[source].entry],['AI','Emergency / priority condition detected + critical details captured'],['ACTION',source==='call'?'Live human transfer triggered':'Normal workflow bypassed + urgent alert triggered'],['CRM','Urgent record + critical context + escalation flag recorded'],['TEAM',source==='call'?`${cap(n().emergency_team)} receives warm handoff`:`${cap(n().emergency_team)} receives immediate internal notification`]];
  function cap(s){return s? s.charAt(0).toUpperCase()+s.slice(1):''}
  function openingLine(){if(source==='call')return '<strong>Inbound call</strong> detected from a new contact.';if(source==='chat')return '<strong>Website chat</strong> opened by a new visitor.';if(source==='sms')return '<strong>Inbound SMS</strong> received from a new contact.';if(source==='email')return '<strong>Inbound email</strong> received from a new contact.';return '<strong>Website form</strong> submitted with customer contact and enquiry details.'}
  function aiGreeting(){const x=n();if(source==='call')return `<span class="ai">AI:</span> “Thanks for calling. How can I help you today?”`;if(source==='chat')return `<span class="ai">AI:</span> “Hi — I can help with your ${x.label.toLowerCase()} enquiry. What do you need help with?”`;if(source==='sms')return '<span class="ai">AI SMS:</span> “Thanks for your message. What can we help you with?”';if(source==='email')return '<span class="ai">AI email reply:</span> “Thanks for contacting us. Please tell us what you need help with.”';return '<span class="ai">AI follow-up:</span> Form details are received. AI contacts the customer through the configured follow-up channel to confirm urgency and the next step.'}

  function normalLeadOpening(x){
    if(source==='call')return [
      {stage:0,html:openingLine()},
      {stage:1,html:aiGreeting()},
      {stage:1,html:`<span class="customer">Customer:</span> “${x.customer}”`}
    ];
    if(source==='chat')return [
      {stage:0,html:openingLine()},
      {stage:1,html:aiGreeting()},
      {stage:1,html:`<span class="customer">Customer:</span> “${x.customer}”`}
    ];
    if(source==='sms')return [
      {stage:0,html:openingLine()},
      {stage:0,html:`<span class="customer">Customer SMS:</span> “${x.customer}”`},
      {stage:1,html:'<span class="ai">AI SMS:</span> “Thanks for the message. I’ll confirm a couple of details so I can route this correctly.”'}
    ];
    if(source==='email')return [
      {stage:0,html:openingLine()},
      {stage:0,html:`<span class="customer">Customer email:</span> “${x.customer}”`},
      {stage:1,html:'<span class="ai">AI email reply:</span> “Thanks for contacting us. I’ll confirm the details needed to arrange the right next step.”'}
    ];
    return [
      {stage:0,html:openingLine()},
      {stage:0,html:`<strong>Form enquiry:</strong> ${x.customer}`},
      {stage:1,html:'<span class="ai">AI follow-up:</span> “Thanks — I’ve received your form. I just need to confirm one detail before I arrange the next step.”'}
    ];
  }

  function emergencyLeadOpening(x){
    if(source==='call')return [
      {stage:0,html:openingLine()},
      {stage:1,html:aiGreeting()},
      {stage:1,html:`<span class="customer">Customer:</span> “${x.emergency}”`}
    ];
    if(source==='chat')return [
      {stage:0,html:openingLine()},
      {stage:1,html:aiGreeting()},
      {stage:1,html:`<span class="customer">Customer:</span> “${x.emergency}”`}
    ];
    if(source==='sms')return [
      {stage:0,html:openingLine()},
      {stage:0,html:`<span class="customer">Customer SMS:</span> “${x.emergency}”`}
    ];
    if(source==='email')return [
      {stage:0,html:openingLine()},
      {stage:0,html:`<span class="customer">Customer email:</span> “${x.emergency}”`}
    ];
    return [
      {stage:0,html:openingLine()},
      {stage:0,html:`<strong>Urgent form enquiry:</strong> ${x.emergency}`}
    ];
  }

  function normalLogs(){
    const x=n();
    const logs=[
      ...normalLeadOpening(x),
      {stage:1,html:`<span class="ai">AI:</span> “${x.urgency_q}”`},
      {stage:1,html:`<span class="customer">Customer:</span> “${x.normal_reply}”`},
      {stage:1,html:'<strong>Qualification:</strong> routine workflow confirmed — emergency / priority escalation is not required.'},
      {stage:1,html:'<span class="ai">AI:</span> “Perfect. I’ll collect the required details and arrange the right next step for you.”'},
      {stage:1,html:`<strong>Captured:</strong> ${x.fields}.`},
      {stage:3,html:`<span class="crm">CRM:</span> contact created or updated and the ${x.service} requirement is written to the contact record.`},
      {stage:2,html:`<span class="ai">AI:</span> “${x.time_q}”`},
      {stage:2,html:`<span class="customer">Customer:</span> “${x.time_reply}”`},
      {stage:2,html:`<span class="action">Availability:</span> approved calendar / team availability checked for ${x.slot}.`},
      {stage:2,html:`<span class="action">Booking:</span> ${x.slot} selected and reserved.`},
      {stage:2,html:`<span class="ai">AI:</span> “${x.confirm}”`},
      {stage:0,html:source==='call'?'<strong>Call completed:</strong> customer ends the call with the next step confirmed.':'<strong>Conversation completed:</strong> customer receives the confirmation through the configured channel.'},
      {stage:3,html:`<span class="crm">CRM:</span> opportunity moved to <strong>${x.stage}</strong> · booking/activity created · conversation summary saved.`},
      {stage:3,html:`<span class="crm">CRM:</span> ${x.task} created and assigned to the selected ${x.team} / configured owner.`},
      {stage:4,html:`<span class="ok">Internal notification:</span> ${cap(x.team)} / team receives the customer details, captured requirement, selected time and AI conversation summary.`},
      {stage:4,html:`<strong>Service execution:</strong> ${cap(x.team)} completes the ${x.completion} / agreed next step.`},
      {stage:3,html:'<span class="crm">CRM:</span> outcome/status is updated to <strong>Completed</strong> or the configured completed stage.'},
      {stage:2,html:'<span class="action">Post-service automation:</span> AI triggers the configured follow-up / review channel after completion.'},
      {stage:2,html:`<span class="ai">AI follow-up:</span> “${x.follow}”`},
      {stage:4,html:'<span class="customer">Customer:</span> submits feedback / review or confirms the outcome.'},
      {stage:3,html:`<span class="crm">CRM:</span> feedback and outcome are attached to the customer record and linked to the assigned ${x.team} / job.`},
      {stage:4,html:`<span class="ok">Owner visibility:</span> admin can review completed work, follow-up and customer feedback by assigned ${x.team} for performance / service-quality tracking.`}
    ];
    return logs;
  }

  function emergencyLogs(){
    const x=n(),digital=source!=='call';
    const logs=[
      ...emergencyLeadOpening(x),
      {stage:1,html:`<span class="urgent"><strong>Emergency / priority rule matched:</strong> ${x.emergency_rule}.</span>`},
      {stage:1,html:'<span class="ai">AI:</span> “I’m treating this as a priority. I only need the critical details required to escalate it immediately.”'},
      {stage:1,html:`<strong>Critical details captured:</strong> ${x.critical}.`},
      {stage:3,html:'<span class="crm">CRM:</span> contact created or updated · urgent opportunity/case created · priority flag = <strong>URGENT</strong> · conversation context saved.'},
      {stage:2,html:'<span class="urgent"><strong>Standard workflow stopped:</strong></span> the case is not pushed through the routine booking / nurture sequence.'}
    ];
    if(digital)logs.push(
      {stage:2,html:'<span class="action">Emergency action:</span> immediate internal alert and urgent callback / response task triggered.'},
      {stage:4,html:`<span class="urgent"><strong>Internal priority notification:</strong></span> ${cap(x.emergency_team)} receives the source, customer contact details, critical context and full captured summary.`},
      {stage:4,html:'<span class="ai">AI:</span> customer is told that the priority case has been escalated and a human team member has been alerted to take over.'},
      {stage:4,html:`<span class="ok">Human takeover:</span> ${cap(x.emergency_team)} opens the urgent record and responds according to the business’s configured escalation process.`}
    );
    else logs.push(
      {stage:2,html:'<span class="action">Emergency action:</span> live transfer is initiated instead of the routine workflow.'},
      {stage:4,html:`<span class="urgent"><strong>Warm handoff:</strong></span> AI transfers the call to the ${x.emergency_team} with the captured priority context.`},
      {stage:4,html:'<span class="ok">Human takeover:</span> the team receives the customer with the context already prepared, so the caller does not need to repeat the full story.'}
    );
    logs.push({stage:3,html:'<span class="crm">CRM continuity:</span> the urgent record stays available for outcome notes, completion status and later follow-up once the human team closes the case.'});
    return logs;
  }

  function getStages(){return flow==='normal'?normalStages():emergencyStages()}
  function getLogs(){return flow==='normal'?normalLogs():emergencyLogs()}
  function getSummary(){const x=n();if(flow==='normal')return `A customer enters through ${sourceMeta[source].label.toLowerCase()}. The AI identifies the need, checks urgency, captures the required ${x.label.toLowerCase()} details, arranges the approved next step, writes the context into the CRM, creates the assignment, notifies the team and later tracks the outcome and follow-up.`;return `A customer enters through ${sourceMeta[source].label.toLowerCase()} with a priority situation. The AI detects the configured escalation condition, captures only the critical information, bypasses the routine path and ${source==='call'?'transfers the live call to the '+x.emergency_team:'creates an immediate internal alert and urgent response task for the '+x.emergency_team} with the CRM context already prepared.`}
  function renderArchitecture(active=-1,doneUntil=-1){stageBox.innerHTML='';getStages().forEach((st,i)=>{const b=document.createElement('button');b.type='button';b.className='stage';b.dataset.stage=String(i);if(i===active)b.classList.add('active');if(i<=doneUntil&&i!==active)b.classList.add('done');b.innerHTML=`<b>${st[0]}</b><span>${st[1]}</span>`;b.addEventListener('click',()=>previewStage(i));stageBox.appendChild(b)})}
  function renderReady(){const x=n();summaryBox.textContent=getSummary();selectedBox.textContent=`${x.label} · ${sourceMeta[source].label} → ${flow==='normal'?'Normal flow':'Emergency / priority flow'}`;renderArchitecture();consoleBox.innerHTML='<div class="console-line ready">Ready. Select “Check AI Functionality” to watch the journey execute step by step.</div>';runBtn.textContent='Check AI Functionality';runBtn.classList.remove('done');runBtn.disabled=false}
  function cancelRun(){runToken++;running=false;runBtn.disabled=false}
  function setSelection(refreshNiches=false){cancelRun();sourceBtns.forEach(b=>b.classList.toggle('active',b.dataset.source===source));flowBtns.forEach(b=>b.classList.toggle('active',b.dataset.flow===flow));if(refreshNiches)renderNiches();renderReady()}
  sourceBtns.forEach(b=>b.addEventListener('click',()=>{if(running)return;source=b.dataset.source;setSelection()}));flowBtns.forEach(b=>b.addEventListener('click',()=>{if(running)return;flow=b.dataset.flow;setSelection()}));
  function appendLine(item){const line=document.createElement('div');line.className='console-line';line.innerHTML=`› ${item.html}`;consoleBox.appendChild(line);consoleBox.scrollTop=consoleBox.scrollHeight}
  function previewStage(stageIndex){if(running)return;const logs=getLogs();consoleBox.innerHTML='';logs.forEach(item=>{if(item.stage<=stageIndex)appendLine(item)});renderArchitecture(stageIndex,stageIndex-1);if(!consoleBox.children.length)consoleBox.innerHTML='<div class="console-line ready">No execution events yet for this stage.</div>';runBtn.textContent='Check AI Functionality';runBtn.classList.remove('done')}
  const wait=ms=>new Promise(r=>setTimeout(r,ms));
  runBtn.addEventListener('click',async()=>{if(running)return;running=true;runBtn.disabled=true;runBtn.textContent='Checking AI Functionality…';runBtn.classList.remove('done');[...nicheTrack.querySelectorAll('button'),...sourceBtns,...flowBtns].forEach(b=>b.disabled=true);const token=++runToken,logs=getLogs();consoleBox.innerHTML='';renderArchitecture(0,-1);let highestDone=-1;for(const item of logs){if(token!==runToken)return;appendLine(item);highestDone=Math.max(highestDone,item.stage-1);renderArchitecture(item.stage,Math.max(highestDone,item.stage-1));await wait(560)}if(token!==runToken)return;renderArchitecture(-1,4);running=false;runBtn.disabled=false;runBtn.textContent='Check AI Functionality';runBtn.classList.add('done');[...nicheTrack.querySelectorAll('button'),...sourceBtns,...flowBtns].forEach(b=>b.disabled=false)});
  renderNiches();setSelection();
})();
</script>
</div>
