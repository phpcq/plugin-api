<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10\Report;

interface DiagnosticBuilderInterface
{
    /**
     * Generic category.
     */
    public const CATEGORY_BUG_RISK = 'bug_risk';

    /**
     * A diagnostic describing some ambiguity.
     */
    public const CATEGORY_CLARITY = 'clarity';

    /**
     * A diagnostic affecting compatibility.
     */
    public const CATEGORY_COMPATIBILITY = 'compatibility';

    /**
     * A diagnostic related to high complexity.
     */
    public const CATEGORY_COMPLEXITY = 'complexity';

    /**
     * Code duplication related.
     */
    public const CATEGORY_DUPLICATION = 'duplication';

    /**
     * A diagnostic related to performance.
     */
    public const CATEGORY_PERFORMANCE = 'performance';

    /**
     * A security related diagnostic.
     */
    public const CATEGORY_SECURITY = 'security';

    /**
     * Code style related diagnostic.
     */
    public const CATEGORY_STYLE = 'style';

    /**
     * Add a file reference to the current diagnostic.
     *
     * @param string $file The path to the file, either absolute or relative to project root.
     *
     * @return FileDiagnosticBuilderInterface
     */
    public function forFile(string $file): FileDiagnosticBuilderInterface;

    /**
     * The optional source of the diagnostic.
     *
     * This may be the name of a check rule within the tool or the like.
     *
     * @param string $source The source of the diagnostic.
     *
     * @return $this
     */
    public function fromSource(string $source): self;

    /**
     * The optional URL containing more information.
     *
     * @param string $url
     *
     * @return $this
     */
    public function withExternalInfoUrl(string $url): self;

    /**
     * A class the diagnostic relates to (can be called multiple times to regard multiple classes).
     *
     * @param string $className
     *
     * @return $this
     */
    public function forClass(string $className): self;

    /**
     * Add a category describing the diagnostic.
     *
     * @param string $category
     *
     * @return $this
     */
    public function withCategory(string $category): self;

    /**
     * End the builder instance.
     *
     * After calling this, no further calls will have any effect.
     *
     * @return TaskReportInterface
     */
    public function end(): TaskReportInterface;
}
