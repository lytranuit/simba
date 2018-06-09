<div class="col-md-12" id="menu">
    <div class="col-md-6">
        <fieldset >
            <legend>Menu</legend>
            <div id="menu-content"class="" style="overflow: visible;">

            </div>
        </fieldset>
    </div>
    <div class="col-md-6">
        <fieldset>
            <legend>Details</legend>
            <div id="menu-details">
                <div class="form-group col-md-6">
                    <label for="text">
                        Text
                    </label>
                    <input class="form-control" name="text" id="text" value="" />
                </div> 
                <div class="form-group col-md-6">
                    <label for="page">
                        Page
                    </label>
                    <select class="form-control" name="page" id="page">
                        @foreach($page as $row)
                        <option value="{{$row['id']}}">{{$row['title']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </fieldset>
    </div>
</div>
<div class="col-md-12">
    <button class="btn btn-success" id="add_menu">Thêm menu</button>
    <button class="btn btn-danger" id="remove_menu">Xoá menu</button>
    <button class="btn btn-primary" id="update_menu">Hoàn tất</button>
</div>
<style>
    #menu fieldset{
        border:1px groove;
        padding: 10px;
        margin: 10px 0px;
    }
    #menu legend{
        display: inline-block;
        width: initial;
        padding: 0px 10px;
    }
</style>
<script>
    $(document).ready(function () {
        var treeview = $("#menu-content").kendoTreeView({
            dragAndDrop: true,
            loadOnDemand: true,
            dataSource: {
                data: <?= json_encode($data) ?>,
                schema: {
                    model: {id: "id", children: "items", fields: {id_page: {editable: true, nullable: true}}}
                }
            },
            dragstart: function (e) {
                console.log($(e.sourceNode));
                if ($(e.sourceNode).find(".k-state-disabled").length > 0) {
                    e.preventDefault();
                }
            },
            drop: function (e) {
                if ($(e.destinationNode).find(".k-state-disabled").length > 0) {
                    e.setValid(false);
                }
            }
        }).data("kendoTreeView");
        var handleTextBox = function (callback) {
            return function (e) {
                if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode) {
                    callback(e);
                }
            };
        };
        var append = handleTextBox(function (e) {
            var selectedNode = treeview.select();
            // passing a falsy value as the second append() parameter
            // will append the new node to the root group
            if (selectedNode.length == 0) {
                selectedNode = null;
            }
            treeview.append({
                text: "New Menu",
                id: 0,
                id_page: 0
            }, selectedNode);
        });
        $("#add_menu").click(append);
        $("#remove_menu").click(function () {
            var selectedNode = treeview.select();
            treeview.remove(selectedNode);
        });

        /*
         * EVENT
         */
        treeview.bind("select", function (e) {
            var dataItems = treeview.dataItem(e.node);
            var text = dataItems.text;
            var id_page = dataItems.id_page;
            $("#text").val(text);
            $("#page").val(id_page);
        });
        $('#page').change(function () {
            var selectedNode = treeview.select();
            var id_page = $(this).val();
            var dataItems = treeview.dataItem(selectedNode);
            dataItems.id_page = id_page;
        });
        $("#text").keyup(function (e) {
            var selectedNode = treeview.select();
            if (selectedNode.length == 0) {
                return false;
            }
            var text = $(this).val();
            selectedNode.find(".k-state-selected").text(text);
            var dataItems = treeview.dataItem(selectedNode);
            dataItems.text = text;
        });
        $("#update_menu").click(function (e) {
            e.preventDefault();
            var $this = $(this);
            var dataItems = treeview.dataSource.data();
            var data = get_data(dataItems);
            if ($this.data('requestRunning')) {
                return;
            }
            $this.data('requestRunning', true);
            $.ajax({
                type: 'POST',
                async: true,
                data: {data: JSON.stringify(data)},
                url: '<?= base_url() ?>/ajax/updatemenu',
                dataType: "JSON",
                success: function (data) {
                    $this.data('requestRunning', false);
                    alert("Thành công!");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        });
        function get_data(dataItems) {
            if ($.type(dataItems) == 'undefined') {
                return [];
            }
            var result = [];
            var length = dataItems.length;
            for (var i = 0; i < length; i++) {
                var items = dataItems[i].items;
                var id = dataItems[i].id;
                var id_page = dataItems[i].id_page;
                var text = dataItems[i].text;
                var data = get_data(items);
                result.push({id: id, id_page: id_page, text: text, child: data});
            }
            return result;
        }
    })
</script>