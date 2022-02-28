<div class="wrapper">
    <table>

        <th> V</th>
        <th> Aktyvus</th>
        <th> ID</th>
        <th> Title </th>
        <th> Slug </th>
        <th> UserId </th>
        <th> Price </th>
        <th> Views </th>
        <th> Action </th>

        <form action="<?= $this->url('admin/massadupdate')?>" method="POST">

            <script language="JavaScript">
                function toggle(source) {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i] != source)
                            checkboxes[i].checked = source.checked;
                    }
                }
            </script>

        <?php
        /**
         * @var \Model\Ad $ad
         */
        foreach($this->data['ads'] as $ad): ?>
        <tr>

            <td> <input type="checkbox" name="ad_id[]" value="<?= $ad->getId()?>"> </td>
            <td> <?= $ad->getActive() ?> </td>
            <td> <?= $ad->getId() ?> </td>
            <td> <?= $ad->getTitle() ?> </td>
            <td> <?= $ad->getSlug() ?> </td>
            <td> <?= $ad->getUserId() ?> </td>
            <td> <?= $ad->getPrice() ?> </td>
            <td> <?= $ad->getVisitor() ?> </td>
            <td>
                <a href="<?= $this->url('admin/adedit', $ad->getId()); ?>"> Edit </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
    <hr>
    <table>
            <td>
                <input type="checkbox" onclick="toggle(this);">Pazymeti visus<br> <br>

                <select name="action">
                    <option value="">Pasirinkite veiksma</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                    <option value="2">Delete</option>
                </select>
                <br>

                <button class="button-41" role="button">Issaugoti</button>
            </td>
        </form>
    </table>
</div>

