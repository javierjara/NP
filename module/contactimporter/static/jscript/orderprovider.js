/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
 $("#table-2").tableDnD({
	    onDragClass: "draprow",
	    onDrop: function(table, row) {
            var rows = table.tBodies[0].rows;
            var debugStr = "";
            for (var i=0; i<rows.length; i++) {
                debugStr += rows[i].id+" ";
            }
              $.ajaxCall("contactimporter.updateOrderProviders",'order='+debugStr);
	    }
	});
});