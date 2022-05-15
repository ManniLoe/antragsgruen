define(["require","exports"],(function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.AntragsgruenEditor=void 0;class i{constructor(e){this.$el=$("#"+e);let t=this.$el.data("ckeditor_initialized");if(void 0!==t&&"1"==t)return void console.error("Already initialized: "+e);this.$el.data("ckeditor_initialized","1"),this.$el.attr("contenteditable","true");let n=i.createConfig(this.$el.attr("title"),"1"==this.$el.data("no-strike"),"1"==this.$el.data("track-changed"),"1"==this.$el.data("allow-diff-formattings"),"1"==this.$el.data("autocolorize"),"br"==this.$el.data("enter-mode")?CKEDITOR.ENTER_BR:CKEDITOR.ENTER_P);CKEDITOR.focusManager._.blurDelay=0,this.editor=CKEDITOR.inline(e,n),this.initMaxLen()}static ckeditor_strip(e){let t=document.createElement("div");return t.innerHTML=e,""==t.textContent&&void 0===t.innerText?"":t.textContent||t.innerText}static ckeditor_charcount(e){let t=e.replace(/(\r\n|\n|\r)/gm,"").replace(/^\s+|\s+$/g,"").replace("&nbsp;","");return t=i.ckeditor_strip(t).replace(/^([\s\t\r\n]*)$/,""),t.length}maxLenOnChange(){let e=i.ckeditor_charcount(this.editor.getData());this.$currCounter.text(e),e>this.maxLen?(this.$warning.removeClass("hidden"),this.maxLenSoft||this.$submit.prop("disabled",!0)):(this.$warning.addClass("hidden"),this.maxLenSoft||this.$submit.prop("disabled",!1))}initMaxLen(){let e=this.$el.parents(".wysiwyg-textarea").first();e.data("max-len")&&(this.maxLen=e.data("max-len"),this.maxLenSoft=!1,this.$warning=e.find(".maxLenTooLong"),this.$submit=this.$el.parents("form").first().find("button[type=submit]"),this.$currCounter=e.find(".maxLenHint .counter"),this.maxLen<0&&(this.maxLenSoft=!0,this.maxLen=-1*this.maxLen),this.editor.on("change",this.maxLenOnChange.bind(this)),this.maxLenOnChange())}static createConfig(e,t,i,n,a,s){let r={coreStyles_strike:{element:"span",attributes:{class:"strike"},overrides:"strike"},coreStyles_underline:{element:"span",attributes:{class:"underline"}},toolbarGroups:[{name:"tools"},{name:"document",groups:["mode","document","doctools"]},{name:"basicstyles",groups:["basicstyles","cleanup"]},{name:"paragraph",groups:["list","indent","blocks","align","bidi"]},{name:"links"},{name:"insert"},{name:"styles"},{name:"colors"},{name:"autocolorize"},{name:"others"}],removePlugins:"stylescombo,save,showblocks,specialchar,about,preview,pastetext,magicline,liststyle",extraPlugins:"tabletools,listitemstyle",scayt_sLang:"de_DE",title:e,enterMode:s,shiftEnterMode:s===CKEDITOR.ENTER_BR?CKEDITOR.ENTER_P:CKEDITOR.ENTER_BR},l=t?"":" s",o=t?"":",strike",d=a?",adminTyped1,adminTyped2":"",c="";return c=i||n?"strong"+l+" em u sub sup;h1 h2 h3 h4(ice-ins,ice-del,ice-cts,appendHint,appendedCollision,moved);ol[start,data-*](ice-ins,ice-del,ice-cts,appendHint,appendedCollision,moved,decimalDot,decimalCircle,lowerAlpha,upperAlpha);li[value,data-*](ice-ins,ice-del,ice-cts,appendHint,appendedCollision,moved);ul[data-*](ice-ins,ice-del,ice-cts,appendHint,appendedCollision,moved);div [data-*](collidingParagraph,hasCollisions,moved);p blockquote [data-*](ice-ins,ice-del,ice-cts,appendHint,appendedCollision,collidingParagraphHead,moved){border,margin,padding};span[data-*](ice-ins,ice-del,ice-cts,appendHint,appendedCollision,underline"+o+",subscript,superscript"+d+");a[href,data-*](ice-ins,ice-del,ice-cts,appendHint,appendedCollision);br ins del[data-*](ice-ins,ice-del,ice-cts,appendHint,appendedCollision);":"strong"+l+" em u sub sup;ul;ol[start](decimalDot,decimalCircle,lowerAlpha,upperAlpha);li[value];h2 h3 h4;p blockquote {border,margin,padding};span(underline"+o+",subscript,superscript"+d+");a[href];",i?(r.extraPlugins+=",lite",r.lite={tooltips:!1},r.removePlugins+=",undo"):r.removePlugins+=",lite",a&&(r.extraPlugins+=",autocolorize"),r.allowedContent=c,r}getEditor(){return this.editor}static destroyInstanceById(e){CKEDITOR.instances[e].destroy();let t=$("#"+e);t.data("ckeditor_initialized","0"),t.attr("contenteditable","false")}}t.AntragsgruenEditor=i}));
//# sourceMappingURL=AntragsgruenEditor.js.map
