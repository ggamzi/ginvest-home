(function(g){var window=this;'use strict';var XTa=function(a,b){var c=(b-a.i)/(a.u-a.i);if(0>=c)return 0;if(1<=c)return 1;for(var d=0,e=1,f=0,h=0;8>h;h++){f=g.cs(a,c);var l=(g.cs(a,c+1E-6)-f)/1E-6;if(1E-6>Math.abs(f-b))return c;if(1E-6>Math.abs(l))break;else f<b?d=c:e=c,c-=(f-b)/l}for(h=0;1E-6<Math.abs(f-b)&&8>h;h++)f<b?(d=c,c=(c+e)/2):(e=c,c=(c+d)/2),f=g.cs(a,c);return c},x5=function(){return{G:"svg",
W:{height:"100%",version:"1.1",viewBox:"0 0 110 26",width:"100%"},U:[{G:"path",Pb:!0,L:"ytp-svg-fill",W:{d:"M 16.68,.99 C 13.55,1.03 7.02,1.16 4.99,1.68 c -1.49,.4 -2.59,1.6 -2.99,3 -0.69,2.7 -0.68,8.31 -0.68,8.31 0,0 -0.01,5.61 .68,8.31 .39,1.5 1.59,2.6 2.99,3 2.69,.7 13.40,.68 13.40,.68 0,0 10.70,.01 13.40,-0.68 1.5,-0.4 2.59,-1.6 2.99,-3 .69,-2.7 .68,-8.31 .68,-8.31 0,0 .11,-5.61 -0.68,-8.31 -0.4,-1.5 -1.59,-2.6 -2.99,-3 C 29.11,.98 18.40,.99 18.40,.99 c 0,0 -0.67,-0.01 -1.71,0 z m 72.21,.90 0,21.28 2.78,0 .31,-1.37 .09,0 c .3,.5 .71,.88 1.21,1.18 .5,.3 1.08,.40 1.68,.40 1.1,0 1.99,-0.49 2.49,-1.59 .5,-1.1 .81,-2.70 .81,-4.90 l 0,-2.40 c 0,-1.6 -0.11,-2.90 -0.31,-3.90 -0.2,-0.89 -0.5,-1.59 -1,-2.09 -0.5,-0.4 -1.10,-0.59 -1.90,-0.59 -0.59,0 -1.18,.19 -1.68,.49 -0.49,.3 -1.01,.80 -1.21,1.40 l 0,-7.90 -3.28,0 z m -49.99,.78 3.90,13.90 .18,6.71 3.31,0 0,-6.71 3.87,-13.90 -3.37,0 -1.40,6.31 c -0.4,1.89 -0.71,3.19 -0.81,3.99 l -0.09,0 c -0.2,-1.1 -0.51,-2.4 -0.81,-3.99 l -1.37,-6.31 -3.40,0 z m 29.59,0 0,2.71 3.40,0 0,17.90 3.28,0 0,-17.90 3.40,0 c 0,0 .00,-2.71 -0.09,-2.71 l -9.99,0 z m -53.49,5.12 8.90,5.18 -8.90,5.09 0,-10.28 z m 89.40,.09 c -1.7,0 -2.89,.59 -3.59,1.59 -0.69,.99 -0.99,2.60 -0.99,4.90 l 0,2.59 c 0,2.2 .30,3.90 .99,4.90 .7,1.1 1.8,1.59 3.5,1.59 1.4,0 2.38,-0.3 3.18,-1 .7,-0.7 1.09,-1.69 1.09,-3.09 l 0,-0.5 -2.90,-0.21 c 0,1 -0.08,1.6 -0.28,2 -0.1,.4 -0.5,.62 -1,.62 -0.3,0 -0.61,-0.11 -0.81,-0.31 -0.2,-0.3 -0.30,-0.59 -0.40,-1.09 -0.1,-0.5 -0.09,-1.21 -0.09,-2.21 l 0,-0.78 5.71,-0.09 0,-2.62 c 0,-1.6 -0.10,-2.78 -0.40,-3.68 -0.2,-0.89 -0.71,-1.59 -1.31,-1.99 -0.7,-0.4 -1.48,-0.59 -2.68,-0.59 z m -50.49,.09 c -1.09,0 -2.01,.18 -2.71,.68 -0.7,.4 -1.2,1.12 -1.49,2.12 -0.3,1 -0.5,2.27 -0.5,3.87 l 0,2.21 c 0,1.5 .10,2.78 .40,3.78 .2,.9 .70,1.62 1.40,2.12 .69,.5 1.71,.68 2.81,.78 1.19,0 2.08,-0.28 2.78,-0.68 .69,-0.4 1.09,-1.09 1.49,-2.09 .39,-1 .49,-2.30 .49,-3.90 l 0,-2.21 c 0,-1.6 -0.2,-2.87 -0.49,-3.87 -0.3,-0.89 -0.8,-1.62 -1.49,-2.12 -0.7,-0.5 -1.58,-0.68 -2.68,-0.68 z m 12.18,.09 0,11.90 c -0.1,.3 -0.29,.48 -0.59,.68 -0.2,.2 -0.51,.31 -0.81,.31 -0.3,0 -0.58,-0.10 -0.68,-0.40 -0.1,-0.3 -0.18,-0.70 -0.18,-1.40 l 0,-10.99 -3.40,0 0,11.21 c 0,1.4 .18,2.39 .68,3.09 .49,.7 1.21,1 2.21,1 1.4,0 2.48,-0.69 3.18,-2.09 l .09,0 .31,1.78 2.59,0 0,-14.99 c 0,0 -3.40,.00 -3.40,-0.09 z m 17.31,0 0,11.90 c -0.1,.3 -0.29,.48 -0.59,.68 -0.2,.2 -0.51,.31 -0.81,.31 -0.3,0 -0.58,-0.10 -0.68,-0.40 -0.1,-0.3 -0.21,-0.70 -0.21,-1.40 l 0,-10.99 -3.40,0 0,11.21 c 0,1.4 .21,2.39 .71,3.09 .5,.7 1.18,1 2.18,1 1.39,0 2.51,-0.69 3.21,-2.09 l .09,0 .28,1.78 2.62,0 0,-14.99 c 0,0 -3.40,.00 -3.40,-0.09 z m 20.90,2.09 c .4,0 .58,.11 .78,.31 .2,.3 .30,.59 .40,1.09 .1,.5 .09,1.21 .09,2.21 l 0,1.09 -2.5,0 0,-1.09 c 0,-1 -0.00,-1.71 .09,-2.21 0,-0.4 .11,-0.8 .31,-1 .2,-0.3 .51,-0.40 .81,-0.40 z m -50.49,.12 c .5,0 .8,.18 1,.68 .19,.5 .28,1.30 .28,2.40 l 0,4.68 c 0,1.1 -0.08,1.90 -0.28,2.40 -0.2,.5 -0.5,.68 -1,.68 -0.5,0 -0.79,-0.18 -0.99,-0.68 -0.2,-0.5 -0.31,-1.30 -0.31,-2.40 l 0,-4.68 c 0,-1.1 .11,-1.90 .31,-2.40 .2,-0.5 .49,-0.68 .99,-0.68 z m 39.68,.09 c .3,0 .61,.10 .81,.40 .2,.3 .27,.67 .37,1.37 .1,.6 .12,1.51 .12,2.71 l .09,1.90 c 0,1.1 .00,1.99 -0.09,2.59 -0.1,.6 -0.19,1.08 -0.49,1.28 -0.2,.3 -0.50,.40 -0.90,.40 -0.3,0 -0.51,-0.08 -0.81,-0.18 -0.2,-0.1 -0.39,-0.29 -0.59,-0.59 l 0,-8.5 c .1,-0.4 .29,-0.7 .59,-1 .3,-0.3 .60,-0.40 .90,-0.40 z"}}]}},
y5=function(a){g.E.call(this);
this.callback=a;this.B=new g.bs(0,0,.4,0,.2,1,1,1);this.delay=new g.Dr(this.next,window,this);this.startTime=this.duration=this.u=this.i=NaN;g.H(this,this.delay)},z5=function(a){g.W.call(this,{G:"div",
L:"ytp-related-on-error-overlay"});var b=this;this.api=a;this.D=this.i=0;this.C=new g.JC(this);this.B=[];this.suggestionData=[];this.containerWidth=0;this.title=new g.W({G:"h2",L:"ytp-related-title",va:"{{title}}"});this.previous=new g.W({G:"button",Ha:["ytp-button","ytp-previous"],W:{"aria-label":"\uc774\uc804\uc758 \ucd94\ucc9c \ub3d9\uc601\uc0c1 \ubcf4\uae30"},U:[g.uK()]});this.S=new y5(function(f){b.suggestions.element.scrollLeft=-f});
this.tileWidth=this.u=0;this.I=!0;this.next=new g.W({G:"button",Ha:["ytp-button","ytp-next"],W:{"aria-label":"\ub354 \ub9ce\uc740 \ucd94\ucc9c \ub3d9\uc601\uc0c1 \ubcf4\uae30"},U:[g.vK()]});g.H(this,this.C);a=a.V();this.K=a.i;g.H(this,this.title);this.title.Ea(this.element);this.suggestions=new g.W({G:"div",L:"ytp-suggestions"});g.H(this,this.suggestions);this.suggestions.Ea(this.element);g.H(this,this.previous);this.previous.Ea(this.element);this.previous.Ra("click",this.sQ,this);g.H(this,this.S);
for(var c={Xq:0};16>c.Xq;c={Xq:c.Xq},c.Xq++){var d=new g.W({G:"a",L:"ytp-suggestion-link",W:{href:"{{link}}",target:a.I,"aria-label":"{{aria_label}}"},U:[{G:"div",L:"ytp-suggestion-image",U:[{G:"div",W:{"data-is-live":"{{is_live}}"},L:"ytp-suggestion-duration",va:"{{duration}}"}]},{G:"div",L:"ytp-suggestion-title",W:{title:"{{hover_title}}"},va:"{{title}}"},{G:"div",L:"ytp-suggestion-author",va:"{{views_or_author}}"}]});g.H(this,d);d.Ea(this.suggestions.element);var e=d.Fa("ytp-suggestion-link");
g.Hm(e,"transitionDelay",c.Xq/20+"s");this.C.T(e,"click",function(f){return function(h){var l=b.suggestionData[f.Xq],m=l.sessionData;g.bN(h,b.api,b.K,m||void 0)&&b.api.Tj(l.videoId,m,l.playlistId)}}(c));
this.B.push(d)}g.H(this,this.next);this.next.Ea(this.element);this.next.Ra("click",this.rQ,this);this.C.T(this.api,"videodatachange",this.onVideoDataChange);this.resize(this.api.eb().getPlayerSize());this.onVideoDataChange();this.show()},A5=function(a){a.next.element.style.bottom=a.D+"px";
a.previous.element.style.bottom=a.D+"px";var b=a.u,c=a.containerWidth-a.suggestionData.length*(a.tileWidth+a.i);g.M(a.element,"ytp-scroll-min",0<=b);g.M(a.element,"ytp-scroll-max",b<=c)},YTa=function(a){for(var b=0;b<a.suggestionData.length;b++){var c=a.suggestionData[b],d=a.B[b],e=c.shortViewCount?c.shortViewCount:c.author,f=c.Kk();
g.kE(a.api.V())&&(f=g.Ui(f,g.$L("emb_rel_err")));d.element.style.display="";var h=d.Fa("ytp-suggestion-title");g.$r.test(c.title)?h.dir="rtl":g.lPa.test(c.title)&&(h.dir="ltr");h=d.Fa("ytp-suggestion-author");g.$r.test(e)?h.dir="rtl":g.lPa.test(e)&&(h.dir="ltr");h=c.isLivePlayback?"\uc2e4\uc2dc\uac04":c.lengthSeconds?g.mL(c.lengthSeconds):"";d.update({views_or_author:e,duration:h,link:f,hover_title:c.title,title:c.title,aria_label:c.Jl||null,is_live:c.isLivePlayback});d=d.Fa("ytp-suggestion-image");
c=c.Ke();d.style.backgroundImage=c?"url("+c+")":""}for(;b<a.B.length;b++)a.B[b].element.style.display="none";A5(a)},B5=function(a){g.gN.call(this,a);
var b=this,c=a.V(),d={G:"svg",W:{fill:"#fff",height:"100%",viewBox:"0 0 24 24",width:"100%"},U:[{G:"path",W:{d:"M0 0h24v24H0V0z",fill:"none"}},{G:"path",W:{d:"M21.58 7.19c-.23-.86-.91-1.54-1.77-1.77C18.25 5 12 5 12 5s-6.25 0-7.81.42c-.86.23-1.54.91-1.77 1.77C2 8.75 2 12 2 12s0 3.25.42 4.81c.23.86.91 1.54 1.77 1.77C5.75 19 12 19 12 19s6.25 0 7.81-.42c.86-.23 1.54-.91 1.77-1.77C22 15.25 22 12 22 12s0-3.25-.42-4.81zM10 15V9l5.2 3-5.2 3z"}}]};g.vE(c)&&(d={G:"svg",W:{fill:"none",height:"100%",viewBox:"0 0 25 25",
width:"100%"},U:[{G:"g",W:{"clip-path":"url(#clip0)",fill:"#fff"},U:[{G:"path",W:{d:"M12.57.98C6.21.98 1.05 6.14 1.05 12.5c0 6.36 5.16 11.52 11.52 11.52 6.36 0 11.52-5.16 11.52-11.52C24.09 6.14 18.93.98 12.57.98zm0 18.34c-3.77 0-6.82-3.05-6.82-6.82 0-3.77 3.05-6.82 6.82-6.82 3.77 0 6.82 3.05 6.82 6.82 0 3.77-3.05 6.82-6.82 6.82z"}},{G:"path",W:{d:"M12.57 6.52c-3.29 0-5.98 2.68-5.98 5.98 0 3.3 2.68 5.98 5.98 5.98 3.3 0 5.98-2.68 5.98-5.98 0-3.3-2.69-5.98-5.98-5.98zm-2.25 9.38V9.1l5.88 3.4-5.88 3.4z"}}]},
{G:"defs",U:[{G:"clipPath",W:{id:"clip0"},U:[{G:"path",W:{d:"M0 0h24v24H0z",fill:"#fff",transform:"translate(.57 .5)"}}]}]}]});c=new g.W({G:"a",L:"ytp-small-redirect",W:{href:g.TE(c),target:c.I,"aria-label":"YouTube\ub97c \ubc29\ubb38\ud558\uc5ec \ub354 \ub9ce\uc740 \ub3d9\uc601\uc0c1 \uac80\uc0c9"},U:[d]});c.Ea(this.element);g.H(this,c);this.i=new z5(a);this.i.Ea(this.element);g.H(this,this.i);this.T(a,"videodatachange",function(){b.show()});
this.resize(this.api.eb().getPlayerSize())},ZTa=function(a,b){a.Fa("ytp-error-content").style.paddingTop="0px";
var c=a.Fa("ytp-error-content"),d=c.clientHeight;a.i.resize(b,b.height-d);c.style.paddingTop=(b.height-a.i.element.clientHeight)/2-d/2+"px"},$Ta=function(a,b){var c,d,e,f,h;
b.reason&&(C5(b.reason)?h=g.az(b.reason):h=g.hN(g.$y(b.reason)),a.od(h,"content"));var l;b.subreason&&(C5(b.subreason)?l=g.az(b.subreason):l=g.hN(g.$y(b.subreason)),a.od(l,"subreason"));if(b.proceedButton&&b.proceedButton.buttonRenderer&&(a=a.Fa("ytp-error-content-wrap-subreason"),h=b.proceedButton.buttonRenderer,b=g.ch("A"),h.text&&h.text.simpleText)){l=h.text.simpleText;b.textContent=l;a:{for(var m=g.Pg("A",a),n=0;n<m.length;n++)if(m[n].textContent===l){l=!0;break a}l=!1}l||(l=null===(d=null===
(c=null===h||void 0===h?void 0:h.navigationEndpoint)||void 0===c?void 0:c.urlEndpoint)||void 0===d?void 0:d.url,h=null===(f=null===(e=null===h||void 0===h?void 0:h.navigationEndpoint)||void 0===e?void 0:e.urlEndpoint)||void 0===f?void 0:f.target,l&&b.setAttribute("href",l),h&&b.setAttribute("target",h),h=g.ch("DIV"),h.appendChild(b),a.appendChild(h))}},C5=function(a){if(a.runs)for(var b=0;b<a.runs.length;b++)if(a.runs[b].navigationEndpoint)return!0;
return!1},D5=function(a,b){g.W.call(this,{G:"a",
Ha:["ytp-impression-link"],W:{target:"{{target}}",href:"{{url}}","aria-label":"YouTube\uc5d0\uc11c \ubcf4\uae30"},U:[{G:"div",L:"ytp-impression-link-content",W:{"aria-hidden":"true"},U:[{G:"div",L:"ytp-impression-link-text",va:"\ub2e4\uc74c\uc5d0\uc11c \ubcf4\uae30:"},{G:"div",L:"ytp-impression-link-logo",U:[x5()]}]}]});this.api=a;this.u=b;this.Pa("target",a.V().I);this.api.Hb(this.element,this,96714);this.T(this.api,"presentingplayerstatechange",this.Nh);this.T(this.api,"videoplayerreset",this.i);
this.T(this.element,"click",this.onClick);this.i()},E5=function(a){g.W.call(this,{G:"div",
L:"ytp-muted-autoplay-endscreen-overlay",U:[{G:"div",L:"ytp-muted-autoplay-end-panel",U:[{G:"div",L:"ytp-muted-autoplay-end-text",va:"{{text}}"}]}]});this.api=a;this.B=this.Fa("ytp-muted-autoplay-end-panel");this.i=new g.$M(this.api);g.H(this,this.i);this.i.Ea(this.B,0);this.api.Hb(this.element,this,52428);this.T(this.api,"presentingplayerstatechange",this.u);this.Ra("click",this.onClick);this.hide()},F5=function(a){g.W.call(this,{G:"div",
L:"ytp-muted-autoplay-overlay",U:[{G:"div",L:"ytp-muted-autoplay-bottom-buttons",U:[{G:"button",Ha:["ytp-muted-autoplay-equalizer","ytp-button"],U:[{G:"div",Ha:["ytp-muted-autoplay-equalizer-icon"],U:[{G:"svg",W:{height:"100%",version:"1.1",viewBox:"-4 -4 24 24",width:"100%"},U:[{G:"g",W:{fill:"#fff"},U:[{G:"rect",L:"ytp-equalizer-bar-left",W:{height:"9",width:"4",x:"1",y:"7"}},{G:"rect",L:"ytp-equalizer-bar-middle",W:{height:"14",width:"4",x:"6",y:"2"}},{G:"rect",L:"ytp-equalizer-bar-right",W:{height:"12",
width:"4",x:"11",y:"4"}}]}]}]}]}]}]});this.api=a;this.bottomButtons=this.Fa("ytp-muted-autoplay-bottom-buttons");this.Fa("ytp-muted-autoplay-equalizer");this.B=new g.I(this.u,4E3,this);a.Hb(this.element,this,39306);this.T(a,"presentingplayerstatechange",this.i);this.T(a,"onMutedAutoplayStarts",this.i);this.Ra("click",this.onClick);this.hide()},G5=function(a,b){g.W.call(this,{G:"div",
L:"ytp-pause-overlay"});var c=this;this.api=a;this.I=b;this.i=new g.JC(this);this.C=new g.ZK(this,1E3,!1,100);this.B=[];this.suggestionData=[];this.containerWidth=0;this.D=!1;this.Z=0;this.title=new g.W({G:"h2",L:"ytp-related-title",va:"{{title}}"});this.previous=new g.W({G:"button",Ha:["ytp-button","ytp-previous"],W:{"aria-label":"\uc774\uc804\uc758 \ucd94\ucc9c \ub3d9\uc601\uc0c1 \ubcf4\uae30"},U:[g.uK()]});this.S=new y5(function(f){c.suggestions.element.scrollLeft=-f});
this.X=this.tileWidth=this.u=0;this.next=new g.W({G:"button",Ha:["ytp-button","ytp-next"],W:{"aria-label":"\ub354 \ub9ce\uc740 \ucd94\ucc9c \ub3d9\uc601\uc0c1 \ubcf4\uae30"},U:[g.vK()]});this.expandButton=new g.W({G:"button",Ha:["ytp-button","ytp-expand"],va:"\ub3d9\uc601\uc0c1 \ub354\ubcf4\uae30"});g.H(this,this.i);g.H(this,this.C);b=a.V();"0"===b.controlsType&&g.L(a.getRootNode(),"ytp-pause-overlay-controls-hidden");this.K=b.i;g.H(this,this.title);this.title.Ea(this.element);this.suggestions=new g.W({G:"div",
L:"ytp-suggestions"});g.H(this,this.suggestions);this.suggestions.Ea(this.element);g.H(this,this.previous);this.previous.Ea(this.element);this.previous.Ra("click",this.uQ,this);g.H(this,this.S);for(a={Yq:0};16>a.Yq;a={Yq:a.Yq},a.Yq++){var d=new g.W({G:"a",L:"ytp-suggestion-link",W:{href:"{{link}}",target:b.I,"aria-label":"{{aria_label}}"},U:[{G:"div",L:"ytp-suggestion-image"},{G:"div",L:"ytp-suggestion-overlay",W:{style:"{{blink_rendering_hack}}","aria-hidden":"{{aria_hidden}}"},U:[{G:"div",L:"ytp-suggestion-title",
va:"{{title}}"},{G:"div",L:"ytp-suggestion-author",va:"{{author_and_views}}"},{G:"div",W:{"data-is-live":"{{is_live}}"},L:"ytp-suggestion-duration",va:"{{duration}}"}]}]});g.H(this,d);d.Ea(this.suggestions.element);var e=d.Fa("ytp-suggestion-link");g.Hm(e,"transitionDelay",a.Yq/20+"s");this.i.T(e,"click",function(f){return function(h){var l=f.Yq;if(1E3>(0,g.P)()-c.Z)g.av(h),document.activeElement.blur();else{l=c.suggestionData[l];var m=l.sessionData;g.bN(h,c.api,c.K,m||void 0)&&c.api.Tj(l.videoId,
m,l.playlistId)}}}(a));
this.B.push(d)}g.H(this,this.next);this.next.Ea(this.element);this.next.Ra("click",this.tQ,this);b=new g.W({G:"button",Ha:["ytp-button","ytp-collapse"],W:{"aria-label":"\ub3d9\uc601\uc0c1 \ub354\ubcf4\uae30 \uc228\uae30\uae30"},U:[{G:"svg",W:{height:"100%",viewBox:"0 0 16 16",width:"100%"},U:[{G:"path",W:{d:"M13 4L12 3 8 7 4 3 3 4 7 8 3 12 4 13 8 9 12 13 13 12 9 8z",fill:"#fff"}}]}]});g.H(this,b);b.Ea(this.element);b.Ra("click",this.sU,this);g.H(this,this.expandButton);this.expandButton.Ea(this.element);
this.expandButton.Ra("click",this.tU,this);this.i.T(this.api,"appresize",this.xb);this.i.T(this.api,"fullscreentoggled",this.wm);this.i.T(this.api,"presentingplayerstatechange",this.Nc);this.i.T(this.api,"videodatachange",this.onVideoDataChange);this.xb(this.api.eb().getPlayerSize());this.onVideoDataChange()},H5=function(a){var b=a.I.Te()?32:16;
b=a.X/2+b;a.next.element.style.bottom=b+"px";a.previous.element.style.bottom=b+"px";b=a.u;var c=a.containerWidth-a.suggestionData.length*(a.tileWidth+8);g.M(a.element,"ytp-scroll-min",0<=b);g.M(a.element,"ytp-scroll-max",b<=c)},aUa=function(a){for(var b=0;b<a.suggestionData.length;b++){var c=a.suggestionData[b],d=a.B[b],e=c.shortViewCount?c.author+" \u2022 "+c.shortViewCount:c.author;
d.element.style.display="";g.kPa.test(c.title)&&(d.Fa("ytp-suggestion-title").dir="rtl");g.kPa.test(e)&&(d.Fa("ytp-suggestion-author").dir="rtl");var f=c.isLivePlayback?"\uc2e4\uc2dc\uac04":c.lengthSeconds?g.mL(c.lengthSeconds):"";var h=c.Kk();g.kE(a.api.V())&&(h=g.Ui(h,g.$L("emb_rel_pause")));d.update({author_and_views:e,duration:f,link:h,title:c.title,aria_label:c.Jl||null,is_live:c.isLivePlayback,aria_hidden:!(!c.Jl||a.api.V().N("embeds_rv_aria_hidden_killswitch")),blink_rendering_hack:g.Ej||g.iE?
"will-change: opacity":void 0});d=d.Fa("ytp-suggestion-image");c=c.Ke();d.style.backgroundImage=c?"url("+c+")":""}for(;b<a.B.length;b++)a.B[b].element.style.display="none";H5(a)},I5=function(a){var b=a.V();
g.W.call(this,{G:"a",Ha:["ytp-watermark","yt-uix-sessionlink"],W:{target:b.I,href:"{{url}}","aria-label":g.AH("$WEBSITE\uc5d0\uc11c \ubcf4\uae30",{WEBSITE:g.FE(b)}),"data-sessionlink":"feature=player-watermark"},U:[x5()]});this.api=a;this.i=null;this.u=!1;this.state=a.zb();a.Hb(this.element,this,76758);this.T(a,"videodatachange",this.lH);this.T(a,"videodatachange",this.onVideoDataChange);this.T(a,"presentingplayerstatechange",this.onStateChange);this.T(a,"appresize",this.xb);b=this.state;this.state!==
b&&(this.state=b);this.lH();this.onVideoDataChange();this.xb(a.eb().getPlayerSize())},J5=function(a){g.FM.call(this,a);
this.J=a;this.u=new g.JC(this);g.H(this,this.u);this.load()};
g.w(y5,g.E);y5.prototype.start=function(a,b,c){this.i=a;this.u=b;this.duration=c;this.startTime=(0,g.P)();this.next()};
y5.prototype.next=function(){var a=(0,g.P)()-this.startTime;var b=this.B;a=XTa(b,a/this.duration);if(0==a)b=b.K;else if(1==a)b=b.S;else{var c=g.ug(b.K,b.D,a),d=g.ug(b.D,b.I,a);b=g.ug(b.I,b.S,a);c=g.ug(c,d,a);d=g.ug(d,b,a);b=g.ug(c,d,a)}b=g.sg(b,0,1);this.callback((this.u-this.i)*b+this.i);1>b&&this.delay.start()};g.w(z5,g.W);g.k=z5.prototype;g.k.hide=function(){this.I=!0;g.W.prototype.hide.call(this)};
g.k.show=function(){this.I=!1;g.W.prototype.show.call(this)};
g.k.isHidden=function(){return this.I};
g.k.rQ=function(){this.scrollTo(this.u-this.containerWidth)};
g.k.sQ=function(){this.scrollTo(this.u+this.containerWidth)};
g.k.resize=function(a,b){var c=this.api.V(),d=16/9,e=650<=a.width,f=480>a.width||290>a.height,h=Math.min(this.suggestionData.length,this.B.length);if(150>=Math.min(a.width,a.height)||0===h||!c.ub)this.hide();else{var l;if(e){var m=l=28;this.i=16}else this.i=m=l=8;if(f){var n=6;e=14;var p=12;f=24;c=12}else n=8,e=18,p=16,f=36,c=16;a=a.width-(48+l+m);l=Math.ceil(a/150);l=Math.min(3,l);l=a/l-this.i;m=Math.floor(l/d);b&&m+100>b&&50<l&&(m=Math.max(b,50/d),l=Math.ceil(a/(d*(m-100)+this.i)),l=a/l-this.i,
m=Math.floor(l/d));50>l||g.pM(this.api)?this.hide():this.show();for(b=0;b<h;b++){d=this.B[b];var r=d.Fa("ytp-suggestion-image");r.style.width=l+"px";r.style.height=m+"px";d.Fa("ytp-suggestion-title").style.width=l+"px";d.Fa("ytp-suggestion-author").style.width=l+"px";d=d.Fa("ytp-suggestion-duration");d.style.display=d&&100>l?"none":""}h=e+n+p+4;this.D=h+c+(m-f)/2;this.suggestions.element.style.height=m+h+"px";this.tileWidth=l;this.containerWidth=a;this.u=0;this.suggestions.element.scrollLeft=-0;A5(this)}};
g.k.onVideoDataChange=function(){var a=this.api.getVideoData(),b=this.api.V();this.K=a.D?!1:b.i;a.suggestions?this.suggestionData=g.Cp(a.suggestions,function(c){return c&&!c.playlistId}):this.suggestionData.length=0;
YTa(this);a.D?this.title.update({title:g.AH("$DNI_RELATED_CHANNEL\uc758 \ub3d9\uc601\uc0c1 \ub354\ubcf4\uae30",{DNI_RELATED_CHANNEL:a.author})}):this.title.update({title:"YouTube\uc5d0\uc11c \ub3d9\uc601\uc0c1 \ub354\ubcf4\uae30"})};
g.k.scrollTo=function(a){a=g.sg(a,this.containerWidth-this.suggestionData.length*(this.tileWidth+this.i),0);this.S.start(this.u,a,1E3);this.u=a;A5(this)};g.w(B5,g.gN);B5.prototype.show=function(){g.gN.prototype.show.call(this);ZTa(this,this.api.eb().getPlayerSize())};
B5.prototype.resize=function(a){g.gN.prototype.resize.call(this,a);ZTa(this,a);g.M(this.element,"related-on-error-overlay-visible",!this.i.isHidden())};
B5.prototype.u=function(a){g.gN.prototype.u.call(this,a);var b=this.api.getVideoData();if(b.SE||b.playerErrorMessageRenderer)(a=b.SE)?$Ta(this,a):b.playerErrorMessageRenderer&&$Ta(this,b.playerErrorMessageRenderer);else{var c;a.xi&&(b.yq?C5(b.yq)?c=g.az(b.yq):c=g.hN(g.$y(b.yq)):c=g.hN(a.xi),this.od(c,"subreason"))}};g.w(D5,g.W);D5.prototype.Nh=function(){this.api.zb().isCued()||(this.hide(),this.api.gb(this.element,!1))};
D5.prototype.i=function(){var a=this.api.getVideoData(),b=this.api.V(),c=this.api.getVideoData().D,d=b.wb,e=!b.ub,f=this.u.vf();b=g.vE(b);d||f||c||e||b||!a.videoId?(this.hide(),this.api.gb(this.element,!1)):(a=g.Ui(this.api.getVideoUrl(),g.$L("emb_imp_woyt")),this.Pa("url",a),this.show())};
D5.prototype.onClick=function(a){var b=g.Ui(this.api.getVideoUrl(),g.$L("emb_imp_woyt"));g.cN(b,this.api,a);this.api.Cb(this.element)};
D5.prototype.show=function(){this.api.zb().isCued()&&(g.W.prototype.show.call(this),this.api.Zv(this.element)&&this.api.gb(this.element,!0))};g.w(E5,g.W);E5.prototype.u=function(){var a=this.api.zb(),b=this.api.getVideoData();this.api.V().N("embeds_enable_muted_autoplay")&&b.mutedAutoplay&&(g.T(a,2)&&!this.yb?(this.show(),this.i.show(),a=this.api.getVideoData(),this.Pa("text",a.FH),g.M(this.element,"ytp-muted-autoplay-show-end-panel",!0),this.api.gb(this.element,this.yb),this.api.Oa("onMutedAutoplayEnds")):this.hide())};
E5.prototype.onClick=function(){var a=this.api.getVideoData(),b=this.api.getCurrentTime();a.mutedAutoplay=!1;a.endSeconds=NaN;g.IF(a);this.api.loadVideoById(a.videoId,b);this.api.Cb(this.element);this.hide()};g.w(F5,g.W);F5.prototype.i=function(){var a=this.api.zb(),b=this.api.getVideoData();this.api.V().N("embeds_enable_muted_autoplay")&&b.mutedAutoplay&&!g.T(a,2)?this.yb||(g.W.prototype.show.call(this),this.B.start(),this.api.gb(this.element,this.yb)):this.hide()};
F5.prototype.u=function(){g.M(this.element,"ytp-muted-autoplay-hide-watermark",!0)};
F5.prototype.onClick=function(){var a=this.api.getVideoData(),b=this.api.getCurrentTime();a.mutedAutoplay=!1;a.endSeconds=NaN;g.IF(a);this.api.loadVideoById(a.videoId,b);this.api.Cb(this.element)};g.w(G5,g.W);g.k=G5.prototype;g.k.hide=function(){g.Nr(this.api.getRootNode(),"ytp-expand-pause-overlay");g.W.prototype.hide.call(this)};
g.k.sU=function(){this.D=!0;g.Nr(this.api.getRootNode(),"ytp-expand-pause-overlay");this.expandButton.focus()};
g.k.tU=function(){this.D=!1;g.L(this.api.getRootNode(),"ytp-expand-pause-overlay")};
g.k.tQ=function(){this.scrollTo(this.u-this.containerWidth)};
g.k.uQ=function(){this.scrollTo(this.u+this.containerWidth)};
g.k.wm=function(){this.xb(this.api.eb().getPlayerSize())};
g.k.Nc=function(a){if(!(g.T(a.state,1)||g.T(a.state,16)||g.T(a.state,32))){var b=!this.api.V().N("embeds_disable_pauseoverlay_on_autoplay_blocked_killswitch")&&g.T(a.state,1024);!g.T(a.state,4)||g.T(a.state,2)||b?this.C.hide():this.suggestionData.length&&(this.D||(g.L(this.api.getRootNode(),"ytp-expand-pause-overlay"),H5(this)),this.C.show(),this.Z=(0,g.P)())}};
g.k.xb=function(a){var b=16/9,c=this.I.Te();a=a.width-(c?112:58);c=Math.ceil(a/(c?320:192));c=(a-8*c)/c;b=Math.floor(c/b);for(var d=0;d<this.B.length;d++){var e=this.B[d].Fa("ytp-suggestion-image");e.style.width=c+"px";e.style.height=b+"px"}this.suggestions.element.style.height=b+"px";this.tileWidth=c;this.X=b;this.containerWidth=a;this.u=0;this.suggestions.element.scrollLeft=-0;H5(this)};
g.k.onVideoDataChange=function(){var a=this.api.V(),b=this.api.getVideoData();this.K=b.D?!1:a.i;b.suggestions?this.suggestionData=g.Cp(b.suggestions,function(c){return c&&!c.playlistId}):this.suggestionData.length=0;
aUa(this);b.D?this.title.update({title:g.AH("$DNI_RELATED_CHANNEL\uc758 \ub3d9\uc601\uc0c1 \ub354\ubcf4\uae30",{DNI_RELATED_CHANNEL:b.author})}):this.title.update({title:"\ub3d9\uc601\uc0c1 \ub354\ubcf4\uae30"})};
g.k.scrollTo=function(a){a=g.sg(a,this.containerWidth-this.suggestionData.length*(this.tileWidth+8),0);this.S.start(this.u,a,1E3);this.u=a;H5(this)};g.w(I5,g.W);g.k=I5.prototype;g.k.lH=function(){var a=this.api.getVideoData(),b=this.api.getVideoData(1).D,c=this.api.V();a=(a.mutedAutoplay||c.wb&&!g.T(this.state,2))&&!(b&&c.pfpChazalUi);g.pK(this,a);this.api.gb(this.element,a)};
g.k.onStateChange=function(a){a=a.state;this.state!==a&&(this.state=a);this.lH()};
g.k.onVideoDataChange=function(){if(this.api.getVideoData().videoId){var a=this.api.getVideoUrl(!0,!1,!1,!0);this.Pa("url",a);this.i||(this.i=this.Ra("click",this.onClick))}else this.i&&(this.Pa("url",null),this.qc(this.i),this.i=null)};
g.k.onClick=function(a){var b=this.api.getVideoUrl(!g.nL(a),!1,!0,!0);g.cN(b,this.api,a);this.api.Cb(this.element)};
g.k.xb=function(a){if((a=480>a.width)&&!this.u||!a&&this.u){var b=new g.W(x5()),c=this.Fa("ytp-watermark");g.M(c,"ytp-watermark-small",a);g.eh(c);b.Ea(c);this.u=a}};g.w(J5,g.FM);g.k=J5.prototype;g.k.Si=function(){return!1};
g.k.create=function(){var a,b=this.J.V(),c=g.iM(this.J),d=null===(a=this.J.getVideoData())||void 0===a?void 0:a.clientPlaybackNonce;d&&g.Az("cpn",d);b.ub&&!b.kc&&(this.D=new G5(this.J,c),g.H(this,this.D),g.sM(this.J,this.D.element,4));b.N("embeds_enable_muted_autoplay")&&(this.i=new F5(this.J),g.H(this,this.i),g.sM(this.J,this.i.element,4),this.C=new E5(this.J),g.H(this,this.C),g.sM(this.J,this.C.element,4));if(b.wb||this.i)this.watermark=new I5(this.J),g.H(this,this.watermark),g.sM(this.J,this.watermark.element,
7);this.B=new D5(this.J,c);g.H(this,this.B);g.sM(this.J,this.B.element,7);this.u.T(this.J,"appresize",this.xb);this.u.T(this.J,"presentingplayerstatechange",this.Nh);this.u.T(this.J,"videodatachange",this.iY);this.u.T(this.J,"onMutedAutoplayStarts",this.onMutedAutoplayStarts);this.Ub(this.J.zb());this.player.Pd("embed")};
g.k.xb=function(){var a=this.J.eb().getPlayerSize();this.Be&&this.Be.resize(a)};
g.k.Nh=function(a){this.Ub(a.state)};
g.k.Ub=function(a){g.T(a,128)?(this.Be||(this.Be=new B5(this.J),g.H(this,this.Be),g.sM(this.J,this.Be.element,4)),this.Be.u(a.getData()),this.Be.show(),g.L(this.J.getRootNode(),"ytp-embed-error")):this.Be&&(this.Be.dispose(),this.Be=null,g.Nr(this.J.getRootNode(),"ytp-embed-error"))};
g.k.onMutedAutoplayStarts=function(){this.J.getVideoData().mutedAutoplay&&this.i&&this.watermark&&this.watermark.Ea(this.i.bottomButtons,0)};
g.k.iY=function(){var a=this.J.getVideoData();this.watermark&&this.i&&!a.mutedAutoplay&&g.ih(this.i.element,this.watermark.element)&&g.sM(this.J,this.watermark.element,7)};g.EM("embed",J5);})(_yt_player);
