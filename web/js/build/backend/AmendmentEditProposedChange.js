define(["require","exports","../shared/AntragsgruenEditor","../frontend/MotionMergeAmendments"],function(t,e,n,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(e){this.$form=e,this.hasChanged=!1,this.textEditCalled(),this.initCollisionDetection(),e.on("submit",function(){$(window).off("beforeunload",t.onLeavePage)})}return t.prototype.textEditCalled=function(){var t=this;$(".wysiwyg-textarea:not(#sectionHolderEditorial)").each(function(e,i){var o=$(i).find(".texteditor"),a=new n.AntragsgruenEditor(o.attr("id")).getEditor();o.parents("form").submit(function(){o.parent().find("textarea.raw").val(a.getData()),void 0!==a.plugins.lite&&(a.plugins.lite.findPlugin(a).acceptAll(),o.parent().find("textarea.consolidated").val(a.getData()))}),$("#"+o.attr("id")).on("keypress",t.onContentChanged.bind(t))}),this.$form.find(".resetText").click(function(t){var e=$(t.currentTarget).parents(".wysiwyg-textarea").find(".texteditor");window.CKEDITOR.instances[e.attr("id")].setData(e.data("original-html")),$(t.currentTarget).parents(".modifiedActions").addClass("hidden")})},t.prototype.initCollisionDetection=function(){var t=this;this.$collisionIndicator=this.$form.find("#collisionIndicator"),window.setInterval(function(){var e=t.getTextConsolidatedSections(),n=t.$form.data("collision-check-url");$.post(n,{_csrf:t.$form.find("> input[name=_csrf]").val(),sections:e},function(e){if(0==e.collisions.length)t.$collisionIndicator.addClass("hidden");else{t.$collisionIndicator.removeClass("hidden");var n="";e.collisions.forEach(function(t){n+=t.html}),t.$collisionIndicator.find(".collisionList").html(n)}})},5e3)},t.prototype.getTextConsolidatedSections=function(){var t={};return $(".proposedVersion .wysiwyg-textarea:not(#sectionHolderEditorial)").each(function(e,n){var o=$(n),a=o.find(".texteditor"),r=o.parents(".proposedVersion").data("section-id"),s=a.clone(!1);s.find(".ice-ins").each(function(t,e){i.MotionMergeChangeActions.insertAccept(e)}),s.find(".ice-del").each(function(t,e){i.MotionMergeChangeActions.deleteAccept(e)}),t[r]=s.html()}),t},t.onLeavePage=function(){return __t("std","leave_changed_page")},t.prototype.onContentChanged=function(){this.hasChanged||(this.hasChanged=!0,$("body").hasClass("testing")||$(window).on("beforeunload",t.onLeavePage))},t}();e.AmendmentEditProposedChange=o});
//# sourceMappingURL=AmendmentEditProposedChange.js.map
