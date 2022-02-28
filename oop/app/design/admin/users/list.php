<?php
/**
 * @var \Model\User $user ;
 */
?>
<div class="wrapper">
    <table>

        <th>V</th>
        <th>Aktyvus</th>
        <th>Id:</th>
        <th>Name:</th>
        <th>Last Name:</th>
        <th>Email:</th>
        <th>Phone:</th>
        <th>Action:</th>





        <form action="<?= $this->url('admin/massuserupdate') ?>" method="POST">

            <script language="JavaScript">
                function toggle(source) {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i] != source)
                            checkboxes[i].checked = source.checked;
                    }
                }
            </script>

            <?php foreach ($this->data['users'] as $user): ?>

                <tr>
                    <td><input type="checkbox" name="user_id[]" value="<?= $user->getId() ?>"></td>
                    <td><?= $user->getActive(); ?></td>
                    <td><?= $user->getId(); ?></td>
                    <td><?= $user->getName(); ?></td>
                    <td><?= $user->getLastName(); ?></td>
                    <td><?= $user->getEmail(); ?></td>
                    <td><?= $user->getPhone(); ?></td>



                    <td>
                        <a href="<?= $this->url('admin/useredit', $user->getId()) ?>">Edit</a>
                    </td>

                </tr>
            <?php endforeach; ?>

    </table>
    <hr>
    <table>
        <td>

            <input type="checkbox" onclick="toggle(this);">Pazymeti visus<br> <br>
            </hr>
            <select name="action">
                <option>Pasirinkite veiksma</option>
                <option value="1">Aktyvuoti</option>
                <option value="0">Deaktyvuoti</option>
                <option value="2">Istrinti</option>
            </select>
            <br>

            <button class="button-41" role="button">Issaugoti</button>
        </td>
    </form>
    </table>
</div>