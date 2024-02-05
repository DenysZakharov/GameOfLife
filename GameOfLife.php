<?php
namespace App;

class GameOfLife
{
    private int $width;
    private int $height;
    private array $grid;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->grid = array_fill(0, $height, array_fill(0, $width, 0));
    }

    public function setCellState(int $x, int $y, int $state): void
    {
        $this->grid[$y][$x] = $state;
    }

    public function applyRules(): void
    {
        $newGrid = $this->grid;

        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $cellState = $this->grid[$y][$x];
                $neighbors = $this->getNeighbors($x, $y);
                $liveNeighbors = array_sum($neighbors);

                if (($cellState == 1) && ($liveNeighbors < 2 || $liveNeighbors > 3)) {
                    $newGrid[$y][$x] = 0;
                } else if ($liveNeighbors == 3) {
                    $newGrid[$y][$x] = 1;
                }
            }
        }

        $this->grid = $newGrid;
    }

    public function display(): void
    {
        foreach ($this->grid as $row) {
            echo implode(' ', array_map(fn($cell) => $cell ? '*' : '.', $row)) . PHP_EOL;
        }
        echo PHP_EOL;
    }

    private function getNeighbors(int $x, int $y): array
    {
        $neighbors = [];

        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                if ($i == 0 && $j == 0) {
                    continue;
                }

                $newX = $x + $i;
                $newY = $y + $j;

                if ($this->isValidCell($newX, $newY)) {
                    $neighbors[] = $this->grid[$newY][$newX];
                }
            }
        }

        return $neighbors;
    }

    private function isValidCell(int $x, int $y): bool
    {
        return $x >= 0 && $x < $this->width && $y >= 0 && $y < $this->height;
    }
}
