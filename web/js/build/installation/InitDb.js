define(["require","exports"],function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var s=function(){function e(e){this.$form=e;var t=e.find(".testDBcaller");this.dbTestUrl=t.data("url"),this.dbTestUrlNotSoPretty=t.data("url-not-so-pretty"),$("#sqlPassword").on("keyup",function(){$("#sqlPasswordNone").prop("checked",!1)}),$("#sqlPasswordNone").on("change",function(){$(this).prop("checked")&&$("#sqlPassword").val("").attr("placeholder","")}),t.click(this.testDb.bind(this)),""==$("#sqlHost").val()&&""==$("#sqlPassword").val()||t.click(),$("#language").on("changed.fu.selectlist",this.gotoLanguageVariant.bind(this))}return e.prototype.gotoLanguageVariant=function(e,t){var s=window.location.href.split("?")[0];s+="?language="+t.value,window.location.href=s},e.prototype.testDbResult=function(e){var t=$(".testDBRpending"),s=$(".testDBsuccess"),a=$(".testDBerror"),r=$(".createTables");e.success?(s.removeClass("hidden"),e.alreadyCreated?r.addClass("alreadyCreated"):r.removeClass("alreadyCreated")):(a.removeClass("hidden"),a.find(".result").text(e.error),r.removeClass("alreadyCreated")),t.addClass("hidden")},e.prototype.testDb=function(){var e=this,t=$(".testDBRpending"),s=$(".testDBsuccess"),a=$(".testDBerror"),r=$("input[name=_csrf]").val(),n={sqlType:$("input[name=sqlType]").val(),sqlHost:$("input[name=sqlHost]").val(),sqlUsername:$("input[name=sqlUsername]").val(),sqlPassword:$("input[name=sqlPassword]").val(),sqlDB:$("input[name=sqlDB]").val(),_csrf:r};$("input[name=sqlPasswordNone]").prop("checked")&&(n.sqlPasswordNone=1),t.removeClass("hidden"),a.addClass("hidden"),s.addClass("hidden"),$.post(this.dbTestUrl,n,this.testDbResult.bind(this)).fail(function(t){404===t.status?(n.disablePrettyUrl="1",$.post(e.dbTestUrlNotSoPretty,n,function(t){e.testDbResult(t),$("input[name=prettyUrls]").val("0")}).fail(function(e){alert("An internal error occurred: "+e.status+" / "+e.responseText)})):alert("An internal error occurred: "+t.status+" / "+t.responseText)})},e}();t.InitDb=s});
//# sourceMappingURL=InitDb.js.map
