
    <?php if(!empty($results)): ?>
    <table class="table" id="mf-contact-list">
        <thead>
            <tr>
                <?php $form_value = unserialize($results[0]->form_value); ?>
                <?php foreach ($form_value as $key => $v) : ?>
                    <?php if ($key != 'cfdb7_status') : ?>
                        <?php $title = str_replace('-', ' ', $key); ?>
                        <th><?php echo ucwords($title); ?></th>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $r) : ?>
                <tr>
                    <?php $form_value = unserialize($r->form_value); ?>
                    <?php foreach ($form_value as $key => $v) : ?>
                        <?php if ($key != 'cfdb7_status') : ?>
                            <td>
                                <?php
                                if (is_array($v)) {
                                    echo implode(' | ', $v);
                                } else {
                                    echo $v;
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