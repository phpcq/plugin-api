<?php

declare(strict_types=1);

namespace Phpcq\PluginApi\Version10;

interface ConfigurationOptionsBuilderInterface
{
    public function describeArrayOption(string $name, string $description, ?array $defaultValue = null): self;

    public function describeIntOption(string $name, string $description, ?int $defaultValue = null): self;

    public function describeStringOption(string $name, string $description, ?string $defaultValue = null): self;

    public function describeBoolOption(string $name, string $description, ?bool $defaultValue = null): self;

    public function describeOption(ConfigurationOptionInterface $configOption): self;

    public function getOptions(): ConfigurationOptionsInterface;
}
