<?php
namespace FluidTYPO3\Vhs\ViewHelpers\Condition\Context;

/*
 * This file is part of the FluidTYPO3/Vhs project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * ### Condition: Is context CLI?
 *
 * A condition ViewHelper which renders the `then` child if
 * current context being rendered is CLI.
 *
 * ### Examples
 *
 *     <!-- simple usage, content becomes then-child -->
 *     <v:condition.context.isCli>
 *         Hooray for CLI contexts!
 *     </v:condition.context.isCli>
 *     <!-- extended use combined with f:then and f:else -->
 *     <v:condition.context.isCli>
 *         <f:then>
 *            Hooray for CLI contexts!
 *         </f:then>
 *         <f:else>
 *            Maybe BE, maybe FE.
 *         </f:else>
 *     </v:condition.context.isCli>
 */
class IsCliViewHelper extends AbstractConditionViewHelper
{
    public static function verdict(array $arguments, RenderingContextInterface $renderingContext)
    {
        return (bool) (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_CLI);
    }
}
