//
// CMSUno
// Plugin CookieBar
//
function f_save_cookiebar(){
	var a=document.getElementById('cookTyp');
	var typ=a.options[a.selectedIndex].value;
	var tex=document.getElementById('cookTex').value;
	var mor=document.getElementById('cookMor').value;
	var url=document.getElementById('cookUrl').value;
	var btn=document.getElementById('cookBtn').value;
	var cco=document.getElementById('cookCco').value;
	a=document.getElementById('cookCo1');
	var co1=a.options[a.selectedIndex].value;
	a=document.getElementById('cookCo2');
	var co2=a.options[a.selectedIndex].value;
	jQuery.post('uno/plugins/cookiebar/cookiebar.php',{'action':'save','unox':Unox,'typ':typ,'tex':tex,'mor':mor,'url':url,'btn':btn,'cco':cco,'co1':co1,'co2':co2},function(r){
		f_alert(r);
	});
}
function f_cookiebar_type(){
	var a=document.getElementById('cookTyp'),b,c,v;
	b=a.options[a.selectedIndex].value;
	c=document.getElementsByClassName("cookTrcc");
	for(v=0;v<c.length;++v)if(b=='cc')c[v].style.display="";else c[v].style.display="none";
	c=document.getElementsByClassName("cookTrw3");
	for(v=0;v<c.length;++v)if(b=='w3')c[v].style.display="";else c[v].style.display="none";
}
