<?php if (!empty($rows)) : ?>
    <table class="table" id="mf-contact-list">
        <thead>
            <tr>
                <?php foreach ($fields as $v) : ?>
                    <?php if ($v != 'cfdb7_status') : ?>
                        <?php $title = str_replace('-', ' ', $v); ?>
                        <th><?php echo ucwords($title); ?></th>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <?php $form_value = unserialize($r->form_value); ?>
                    <?php foreach ($fields as $v) : ?>
                        <?php if ($v != 'cfdb7_status') : ?>
                            <td>
                                <?php
                                if (!empty($form_value[$v])) {
                                    if (is_array($form_value[$v])) {
                                        echo implode(' | ', $form_value[$v]);
                                    } else {
                                        echo $form_value[$v];
                                    }
                                } 
                                ?>
                            </td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        jQuery(document).ready(function($) {
            $('#mf-contact-list').DataTable({
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                ]
            });
        });
    </script>
<?php endif; ?>