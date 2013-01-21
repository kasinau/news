/**
 * Created with JetBrains PhpStorm.
 * User: radu
 * Date: 1/21/13
 * Time: 10:48 PM
 */

$(document).ready(function(){
    $('#category').change(function(){
        if (this.value == 'new_category') {
            $('#category_field').html(
                '<input type="text" name="category" id="category" />' +
                '<input type="hidden" name="is_new" value="true" />'
            );
        }
    });
});
