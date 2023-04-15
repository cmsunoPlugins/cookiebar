//
// CMSUno
// Plugin CookieBar
//
function f_save_cookiebar(){
	let h=new FormData(),a=document.getElementById('cookTyp');
	h.set('action','save');
	h.set('unox',Unox);
	h.set('typ',a.options[a.selectedIndex].value);
	h.set('tex',document.getElementById('cookTex').value);
	h.set('mor',document.getElementById('cookMor').value);
	h.set('url',document.getElementById('cookUrl').value);
	h.set('btn',document.getElementById('cookBtn').value);
	h.set('cco',document.getElementById('cookCco').value);
	a=document.getElementById('cookCo1');
	h.set('co1',a.options[a.selectedIndex].value);
	a=document.getElementById('cookCo2');
	h.set('co2',a.options[a.selectedIndex].value);
	fetch('uno/plugins/cookiebar/cookiebar.php',{method:'post',body:h})
	.then(r=>r.text())
	.then(r=>f_alert(r));
}
function f_cookiebar_type(){
	let a=document.getElementById('cookTyp'),b,c,v;
	b=a.options[a.selectedIndex].value;
	c=document.getElementsByClassName("cookTrcc");
	for(v=0;v<c.length;++v){
		if(b=='cc')c[v].style.display="";
		else c[v].style.display="none";
	}
	c=document.getElementsByClassName("cookTrw3");
	for(v=0;v<c.length;++v){
		if(b=='w3')c[v].style.display="";
		else c[v].style.display="none";
	}
}
