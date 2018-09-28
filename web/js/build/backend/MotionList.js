define(["require","exports"],function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=function(){function t(){this.initList(),this.initExportRow()}return t.prototype.initList=function(){$(".markAll").click(function(t){$(".adminMotionTable").find("input.selectbox").prop("checked",!0),t.preventDefault()}),$(".markNone").click(function(t){$(".adminMotionTable").find("input.selectbox").prop("checked",!1),t.preventDefault()}),$(".deleteMarkedBtn").click(this.onDeleteClicked.bind(this));var t=$("#initiatorSelect"),e=t.data("values"),n={hint:!0,highlight:!0,minLength:1},i=[{name:"supporter",source:function(t,n){var i,o;i=[],o=new RegExp(t,"i"),$.each(e,function(t,e){o.test(e)&&i.push(e)}),n(i)}}];t.typeahead(n,i),$(".adminMotionTable").colResizable({liveDrag:!0,postbackSafe:!0,minWidth:30})},t.prototype.initExportRow=function(){var t=$(".motionListExportRow");t.find("li.checkbox").on("click",function(t){t.stopPropagation()}),t.find(".exportMotionDd, .exportAmendmentDd").each(function(){var t=$(this);t.find("input[type=checkbox]").change(function(){var e=t.find("input[name=withdrawn]").prop("checked")?1:0;t.find(".exportLink a").each(function(){var t=$(this).data("href-tpl");t=t.replace("WITHDRAWN",e),$(this).attr("href",t)})}).trigger("change")})},t.prototype.onDeleteClicked=function(t){t.preventDefault();var e=$(t.target),n=e.parents("form");bootbox.confirm(__t("std","del_confirm"),function(t){if(t){var i=$('<input type="hidden">').attr("name",e.attr("name")).attr("value",e.attr("value"));n.append(i),n.submit()}})},t}();e.MotionList=n});
//# sourceMappingURL=MotionList.js.map
