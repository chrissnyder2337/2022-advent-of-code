<?php declare(strict_types=1);

namespace AdventOfCode\ConsoleCommand;

use Symfony\Component\Console;
use Symfony\Component\Console\Command\Command;

/**
 * Advent of Code Day One solution.
 *
 * @see https://adventofcode.com/2022/day/1
 */
class DayOneCommand extends Command {

    protected static $defaultName = 'day1';

    public function __construct() {
        parent::__construct(self::$defaultName);
    }

    protected function configure() {
        $this->setDescription('Advent of Code Day 1');
        $this->addArgument('input-file', Console\Input\InputArgument::REQUIRED, 'File name of puzzle input.');
    }

    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output): int {

        $filename = $input->getArgument('input-file');
        $puzzleInputContents = file_get_contents($filename);

        $output->writeln('Solution: ' . $this->solvePuzzle($puzzleInputContents));

        return self::SUCCESS;
    }

    /**
     * @param string $input
     *   The puzzle input.
     *
     * @return string
     *   The puzzle solution.
     */
    protected function solvePuzzle(string $input): string {
        $calorieData = explode(PHP_EOL, $input);

        $fattestElfCalorieCount = 0;
        $currentElfCalorieCount = 0;
        foreach ($calorieData as $calorie) {
            // elf separator
            if ($calorie === "") {
                // set current elf's calorie count as fattest if they are the fattest.
                if ($currentElfCalorieCount > $fattestElfCalorieCount) {
                    $fattestElfCalorieCount = $currentElfCalorieCount;
                }
                $currentElfCalorieCount = 0;
                continue;
            }

            $currentElfCalorieCount += (int) $calorie;
        }
        // set current elf's calorie count as fattest if they are the fattest.
        if ($currentElfCalorieCount > $fattestElfCalorieCount) {
            $fattestElfCalorieCount = $currentElfCalorieCount;
        }

        return (string) $fattestElfCalorieCount;
    }
}