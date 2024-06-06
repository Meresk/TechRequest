<?php
/**
 * @var \App\Models\Application $application
 *@var \App\Models\User $user
 */
?>

<tr>
    <td style="width: 200px;"><?php echo $application->id() ?></td>
    <td style="width: 200px;"><?php echo $application->status() ?></td>
    <td style="width: 200px;"><?php echo $user->name() ?></td>
    <td style="width: 220px;"><?php echo $application->reason() ?></td>
    <td>
        <div class="dropdown d-flex justify-content-end">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Действия </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="executor/application?id=<?php echo $application->id() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-lg" viewBox="0 0 16 16">
                            <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0"/>
                        </svg>
                        <span>Подробности</span>
                    </a>
                </li>
            </ul>
        </div>
    </td>
</tr>