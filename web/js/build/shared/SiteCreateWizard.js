var FUNCTIONALITY_MOTIONS=1,FUNCTIONALITY_MANIFESTO=2,FUNCTIONALITY_APPLICATIONS=3,FUNCTIONALITY_AGENDA=4,FUNCTIONALITY_SPEECH_LISTS=5,SiteCreateWizard=function(){function e(e){var n=this;this.$root=e,this.panelConditions={panelLanguage:function(){return"#panelLanguage"===n.firstPanel},panelFunctionality:function(){return!0},panelSingleMotion:function(e){return n.hasMotionlikeType(e)},panelMotionWho:function(e){return n.hasMotionlikeType(e)&&0===e.singleMotion},panelMotionDeadline:function(e){return n.hasMotionlikeType(e)&&0===e.singleMotion&&1!==e.motionsInitiatedBy},panelMotionScreening:function(e){return n.hasMotionlikeType(e)&&0===e.singleMotion&&1!==e.motionsInitiatedBy},panelNeedsSupporters:function(e){return n.hasMotionlikeType(e)&&0===e.singleMotion&&1!==e.motionsInitiatedBy},panelHasAmendments:function(e){return n.hasMotionlikeType(e)},panelAmendSinglePara:function(e){return n.hasMotionlikeType(e)&&1===e.hasAmendments},panelAmendWho:function(e){return n.hasMotionlikeType(e)&&1===e.hasAmendments},panelAmendDeadline:function(e){return n.hasMotionlikeType(e)&&1===e.hasAmendments&&1!==e.amendmentInitiatedBy},panelAmendMerging:function(e){return n.hasMotionlikeType(e)&&1===e.hasAmendments&&1!==e.amendmentInitiatedBy},panelAmendScreening:function(e){return n.hasMotionlikeType(e)&&1===e.hasAmendments&&1!==e.amendmentInitiatedBy},panelComments:function(e){return n.hasMotionlikeType(e)},panelApplicationType:function(e){return-1!==e.functionality.indexOf(FUNCTIONALITY_APPLICATIONS)},panelSpeechLogin:function(e){return-1!==e.functionality.indexOf(FUNCTIONALITY_SPEECH_LISTS)},panelSpeechQuotas:function(e){return-1!==e.functionality.indexOf(FUNCTIONALITY_SPEECH_LISTS)},panelOpenNow:function(){return!0},panelSiteData:function(){return!0}},this.firstPanel=$("#SiteCreateWizard").data("init-step"),this.mode=$("#SiteCreateWizard").data("mode"),this.initEvents()}return e.prototype.getRadioValue=function(e,n){var t=this.$root.find("fieldset."+e).find("input:checked");return 0<t.length?t.val():n},e.prototype.getCheckboxValues=function(e,n){var t=this.$root.find("fieldset."+e).find("input:checked").toArray();return 0<t.length?t.map(function(e){return parseInt(e.getAttribute("value"),10)}):n},e.prototype.getWizardState=function(){var e;return{language:this.getRadioValue("language",null),functionality:this.getCheckboxValues("functionality",[]),singleMotion:parseInt(this.getRadioValue("singleMotion",0),10),motionsInitiatedBy:parseInt(this.getRadioValue("motionWho",1),10),motionsDeadlineExists:parseInt(this.getRadioValue("motionDeadline",0),10),motionsDeadline:this.$root.find("fieldset.motionDeadline .date input").val(),motionScreening:parseInt(this.getRadioValue("motionScreening",1),10),needsSupporters:parseInt(this.getRadioValue("needsSupporters",0),10),minSupporters:(e=this.$root.find("input.minSupporters").val(),""===e||null===e?null:parseInt(e,10)),hasAmendments:parseInt(this.getRadioValue("hasAmendments",1),10),amendSinglePara:parseInt(this.getRadioValue("amendSinglePara",0),10),amendMerging:parseInt(this.getRadioValue("amendMerging",0),10),amendmentInitiatedBy:parseInt(this.getRadioValue("amendmentWho",1),10),amendmentDeadlineExists:parseInt(this.getRadioValue("amendmentDeadline",0),10),amendmentDeadline:this.$root.find("fieldset.amendmentDeadline .date input").val(),amendScreening:parseInt(this.getRadioValue("amendScreening",1),10),hasComments:parseInt(this.getRadioValue("hasComments",1),10),applicationType:parseInt(this.getRadioValue("applicationType",1),10),speechQuotas:parseInt(this.getRadioValue("speechQuotas",1),10),speechLogin:parseInt(this.getRadioValue("speechLogin",1),10),openNow:parseInt(this.getRadioValue("openNow",0),10),title:$("#siteTitle").val(),organization:$("#siteOrganization").val(),subdomain:$("#siteSubdomain").val(),contact:$("#siteContact").val()}},e.prototype.showPanel=function(e){this.data=this.getWizardState();var n=e.data("tab");this.$root.find(".wizard .steps li").removeClass("active"),this.$root.find(".wizard .steps ."+n).addClass("active"),this.$activePanel&&this.$activePanel.removeClass("active").addClass("inactive"),e.addClass("active").removeClass("inactive"),this.$activePanel=e,window.setTimeout(function(){0<e.find("input:checked").length?e.find("input:checked").trigger("focus"):0<e.find("button[type=submit]").length&&e.find("button[type=submit]").trigger("focus")},100);try{var t=window.location.hash=="#"+e.attr("id");""!=window.location.hash&&"#"!=window.location.hash||"#"+e.attr("id")!=this.firstPanel||(t=!0),t||(window.location.hash="#"+e.attr("id").substring(5))}catch(e){console.log(e)}},e.prototype.hasMotionlikeType=function(e){return-1!==e.functionality.indexOf(FUNCTIONALITY_MOTIONS)||-1!==e.functionality.indexOf(FUNCTIONALITY_MANIFESTO)},e.prototype.getNextPanel=function(){this.data=this.getWizardState();for(var e=this.$activePanel.attr("id"),n=Object.keys(this.panelConditions),t=!1,i=0;i<n.length;i++)if(n[i]===e)t=!0;else if(t&&this.panelConditions[n[i]](this.data))return"#"+n[i];console.error("Could not find the next panel for "+e+", data: ",this.data)},e.prototype.subdomainChange=function(e){var n=this,t=$(e.currentTarget),i=t.val(),a=t.parents(".subdomainRow").first(),o=t.data("query-url").replace(/SUBDOMAIN/,i),s=a.find(".subdomainError");return""===i?(s.addClass("hidden"),void a.removeClass("has-error").removeClass("has-success")):i.match(/^[A-Z0-9äöü](?:[A-Z0-9äöü_\-]{0,61}[A-Z0-9äöü])?$/i)?void $.get(o,function(e){e.available?(s.addClass("hidden"),a.removeClass("has-error"),n.$root.find("button[type=submit]").prop("disabled",!1),e.subdomain==t.val()&&a.addClass("has-success")):(s.removeClass("hidden"),s.html(s.data("template").replace(/%SUBDOMAIN%/,e.subdomain)),a.removeClass("has-success"),e.subdomain==t.val()&&(n.$root.find("button[type=submit]").prop("disabled",!0),a.addClass("has-error")))}):(a.removeClass("has-success").addClass("has-error"),void this.$root.find("button[type=submit]").prop("disabled",!0))},e.prototype.initEvents=function(){var i=this,t=this.$root;this.$activePanel=null,this.data=this.getWizardState(),t.find("input").on("change",function(){i.data=i.getWizardState()}),t.find(".radio-label input").on("change",function(){var e=$(this).parents("fieldset").first();e.find(".radio-label").removeClass("active"),e.find(".radio-label input:checked").parents(".radio-label").first().addClass("active")}).trigger("change"),t.find(".checkbox-label input").on("change",function(){var e=$(this);e.prop("checked")?e.parents(".checkbox-label").first().addClass("active"):e.parents(".checkbox-label").first().removeClass("active")}).trigger("change"),t.find("fieldset.functionality input").on("change",function(){var e=t.find("fieldset.functionality input:checked").data("wording-name");t.removeClass("wording_motion").removeClass("wording_manifesto").addClass("wording_"+e)}).trigger("change"),t.find(".input-group.date").each(function(){var e=$(this);e.datetimepicker({locale:e.find("input").data("locale")})}),t.find(".date.motionsDeadline").on("dp.change",function(){$("input.motionsDeadlineExists").prop("checked",!0).trigger("change")}),t.find(".date.amendmentDeadline").on("dp.change",function(){$("input.amendDeadlineExists").prop("checked",!0).trigger("change")}),t.find("input.minSupporters").on("change",function(){$("input.needsSupporters").prop("checked",!0).trigger("change")}),t.find("#siteSubdomain").on("keyup change",this.subdomainChange.bind(this)),t.find("#siteTitle").on("keyup change",function(){5<=$(this).val().length?$(this).parents(".form-group").first().addClass("has-success"):$(this).parents(".form-group").first().removeClass("has-success")}),t.find("#siteOrganization").on("keyup change",function(){5<=$(this).val().length?$(this).parents(".form-group").first().addClass("has-success"):$(this).parents(".form-group").first().removeClass("has-success")}),t.find("#panelSiteData input").on("keypress",function(e){var n=e.originalEvent;13!==n.charCode&&13!==n.keyCode||e.preventDefault()}),t.find("#panelLanguage input").on("change",function(){var e=t.find("#panelLanguage input:checked").val(),n=t.find("#panelLanguage").data("url").replace(/LNG/,e);window.location.href=n});var n=this;t.on("keypress",function(e){"Enter"===e.key&&"submit"!==i.$activePanel.find(".btn-next").attr("type")&&(e.preventDefault(),e.stopPropagation(),i.showPanel($(n.getNextPanel())))}),t.find(".navigation .btn-next").on("click",function(e){"submit"!==$(e.currentTarget).attr("type")&&(e.preventDefault(),n.showPanel($(n.getNextPanel())))}),t.find(".navigation .btn-prev").on("click",function(e){e.preventDefault(),""!=window.location.hash&&window.history.back()}),$(window).on("hashchange",function(e){var n;e.preventDefault(),n=""===window.location.hash||0===parseInt(window.location.hash.substring(1))?i.firstPanel:"#panel"+window.location.hash.substring(1);var t=$(n);0<t.length&&i.showPanel(t)}),t.find(".step-pane").addClass("inactive"),this.showPanel($(this.firstPanel))},e}();
//# sourceMappingURL=SiteCreateWizard.js.map
