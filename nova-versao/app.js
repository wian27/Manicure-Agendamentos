'use strict';
const key='agenda_pro_demo_v1',initial={clients:[],services:[{id:'s1',name:'Manicure',minutes:60,price:40},{id:'s2',name:'Pedicure',minutes:60,price:45}],appointments:[]};
let data;try{const raw=JSON.parse(localStorage.getItem(key));data=raw&&Array.isArray(raw.clients)&&Array.isArray(raw.services)&&Array.isArray(raw.appointments)?raw:structuredClone(initial)}catch{data=structuredClone(initial)}
const $=id=>document.getElementById(id),esc=s=>String(s??'').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c])),save=()=>localStorage.setItem(key,JSON.stringify(data)),uid=()=>crypto.randomUUID(),money=n=>Number(n).toLocaleString('pt-BR',{style:'currency',currency:'BRL'}),dateLocal=()=>{const d=new Date();return [d.getFullYear(),String(d.getMonth()+1).padStart(2,'0'),String(d.getDate()).padStart(2,'0')].join('-')},notify=s=>{$('notice').textContent=s;};
$('today').textContent=new Intl.DateTimeFormat('pt-BR',{dateStyle:'long'}).format(new Date());$('filterDate').value=dateLocal();
document.querySelectorAll('[data-tab]').forEach(b=>b.addEventListener('click',()=>{document.querySelectorAll('[data-tab]').forEach(x=>x.classList.toggle('active',x===b));document.querySelectorAll('.panel').forEach(x=>x.classList.toggle('hidden',x.id!==b.dataset.tab));notify('')}));
function render(){const day=$('filterDate').value;const apps=data.appointments.filter(a=>a.day===day).sort((a,b)=>a.time.localeCompare(b.time));$('appointmentList').innerHTML=apps.length?apps.map(a=>{const c=data.clients.find(x=>x.id===a.clientId),s=data.services.find(x=>x.id===a.serviceId);return '<article class="item"><div><strong>'+esc(a.time)+' · '+esc(c?.name||'Cliente removido')+'</strong><p>'+esc(s?.name||'Serviço removido')+' · '+esc(a.status)+'</p></div><div class="actions"><button data-action="complete" data-id="'+esc(a.id)+'">Concluir</button><button data-action="cancel" data-id="'+esc(a.id)+'">Cancelar</button></div></article>'}).join(''):'<p class="muted">Nenhum agendamento para este dia.</p>';
$('clientList').innerHTML=data.clients.length?data.clients.map(c=>'<article class="item"><div><strong>'+esc(c.name)+'</strong><p>'+esc(c.phone||'Sem telefone')+'</p></div><button data-action="deleteClient" data-id="'+esc(c.id)+'">Excluir</button></article>').join(''):'<p class="muted">Nenhum cliente cadastrado.</p>';
$('serviceList').innerHTML=data.services.map(s=>'<article class="item"><div><strong>'+esc(s.name)+'</strong><p>'+esc(s.minutes)+' min · '+money(s.price)+'</p></div><button data-action="deleteService" data-id="'+esc(s.id)+'">Excluir</button></article>').join('')||'<p class="muted">Nenhum serviço cadastrado.</p>';}
function form(title,fields,handler){$('formTitle').textContent=title;$('fields').innerHTML=fields;$('editor').showModal();$('editForm').onsubmit=e=>{e.preventDefault();try{handler(new FormData(e.currentTarget));save();render();$('editor').close();notify('Alterações salvas nesta demonstração.')}catch(err){notify(err.message)}}}
$('cancel').onclick=()=>$('editor').close();
$('newClient').onclick=()=>form('Novo cliente','<label>Nome <input name="name" maxlength="100" required></label><label>Telefone (opcional) <input name="phone" maxlength="30" type="tel"></label>',f=>{data.clients.push({id:uid(),name:String(f.get('name')).trim(),phone:String(f.get('phone')).trim()})});
$('newService').onclick=()=>form('Novo serviço','<label>Serviço <input name="name" maxlength="100" required></label><label>Duração em minutos <input name="minutes" type="number" min="15" max="480" step="15" value="60" required></label><label>Preço (R$) <input name="price" type="number" min="0" max="100000" step=".01" required></label>',f=>{data.services.push({id:uid(),name:String(f.get('name')).trim(),minutes:Number(f.get('minutes')),price:Number(f.get('price'))})});
$('newAppointment').onclick=()=>{if(!data.clients.length)return notify('Cadastre um cliente antes de agendar.');if(!data.services.length)return notify('Cadastre um serviço antes de agendar.');const options=(arr)=>arr.map(x=>'<option value="'+esc(x.id)+'">'+esc(x.name)+'</option>').join('');form('Novo agendamento','<label>Cliente <select name="clientId" required>'+options(data.clients)+'</select></label><label>Serviço <select name="serviceId" required>'+options(data.services)+'</select></label><label>Data <input name="day" type="date" value="'+esc($('filterDate').value)+'" required></label><label>Horário <input name="time" type="time" required></label>',f=>{const day=String(f.get('day')),time=String(f.get('time')),serviceId=String(f.get('serviceId')),clientId=String(f.get('clientId'));const svc=data.services.find(s=>s.id===serviceId);if(!svc||!data.clients.some(c=>c.id===clientId))throw Error('Cliente ou serviço inválido.');const start=Number(time.slice(0,2))*60+Number(time.slice(3));if(!/^\d{4}-\d{2}-\d{2}$/.test(day)||!/^\d{2}:\d{2}$/.test(time)||start>=1440)throw Error('Data ou horário inválido.');const clash=data.appointments.some(a=>{if(a.day!==day||a.status==='Cancelado')return false;const old=data.services.find(s=>s.id===a.serviceId),t=Number(a.time.slice(0,2))*60+Number(a.time.slice(3));return start<t+(old?.minutes||60)&&t<start+svc.minutes});if(clash)throw Error('Conflito de horários: escolha outro período.');data.appointments.push({id:uid(),day,time,clientId,serviceId,status:'Agendado'});$('filterDate').value=day;})};
$('filterDate').addEventListener('change',render);
document.addEventListener('click',e=>{const b=e.target.closest('[data-action]');if(!b)return;const id=b.dataset.id,act=b.dataset.action;if(act==='deleteClient'){if(data.appointments.some(a=>a.clientId===id))return notify('Cliente com agendamento registrado não pode ser excluído.');if(confirm('Excluir cliente?'))data.clients=data.clients.filter(c=>c.id!==id)}else if(act==='deleteService'){if(data.appointments.some(a=>a.serviceId===id))return notify('Serviço com agendamento registrado não pode ser excluído.');if(confirm('Excluir serviço?'))data.services=data.services.filter(s=>s.id!==id)}else{const a=data.appointments.find(x=>x.id===id);if(a)a.status=act==='complete'?'Concluído':'Cancelado'}save();render()});render();
$('exportBackup').addEventListener('click',()=>{const blob=new Blob([JSON.stringify({version:1,exportedAt:new Date().toISOString(),data},null,2)],{type:'application/json'});const url=URL.createObjectURL(blob);const link=document.createElement('a');link.href=url;link.download='agenda-pro-backup.json';link.click();setTimeout(()=>URL.revokeObjectURL(url),1000)});
$('importBackup').addEventListener('change',async e=>{const file=e.target.files?.[0];if(!file)return;try{if(file.size>2_000_000)throw Error('Arquivo muito grande.');const parsed=JSON.parse(await file.text());const v=parsed?.data;if(parsed.version!==1||!v||!['clients','services','appointments'].every(k=>Array.isArray(v[k]))||v.clients.length>10000||v.services.length>10000||v.appointments.length>50000)throw Error('Formato de backup inválido.');if(!confirm('Substituir todos os dados locais pelos dados do backup?'))return;data=v;save();render();notify('Backup restaurado neste navegador.')}catch(err){notify('Falha ao importar: '+err.message)}finally{e.target.value=''}});
if('serviceWorker' in navigator)window.addEventListener('load',()=>navigator.serviceWorker.register('./sw.js').catch(()=>{}));

let installPrompt;
const installButton = document.getElementById('installApp');
const installHelp = document.getElementById('installHelp');
window.addEventListener('beforeinstallprompt', event => {
  event.preventDefault();
  installPrompt = event;
  installButton.hidden = false;
  installHelp.hidden = true;
});
installButton.addEventListener('click', async () => {
  if (!installPrompt) return;
  const prompt = installPrompt;
  installPrompt = null;
  installButton.hidden = true;
  await prompt.prompt();
  await prompt.userChoice;
  installHelp.hidden = false;
});
window.addEventListener('appinstalled', () => {
  installButton.hidden = true;
  installHelp.textContent = 'Aplicativo instalado neste dispositivo.';
  installHelp.hidden = false;
});
if (window.matchMedia('(display-mode: standalone)').matches) {
  document.getElementById('installPanel').hidden = true;
}
